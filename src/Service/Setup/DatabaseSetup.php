<?php

namespace App\Service\Setup;

use App\ServiceInterface\Setup\DatabaseSetupCommandProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Exception;
use RuntimeException;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use function count;
use function in_array;


final class DatabaseSetup implements DatabaseSetupCommandProviderInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function getCommands(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): array
    {
        try {
            if (!$this->isDatabasePresent()) {
                return [
                    'doctrine:database:create',
                    'doctrine:migrations:migrate' => ['--no-interaction' => true],
                ];
            }
        } catch (Exception $e) {
        }

        return array_merge($this->setupDatabase($input, $output, $questionHelper), [
            'doctrine:migrations:version' => [
                '--add' => true,
                '--all' => true,
                '--no-interaction' => true,
            ],
        ]);
    }

    /**
     * @throws Exception
     */
    private function isDatabasePresent(): bool
    {
        $databaseName = $this->getDatabaseName();

        try {
            $schemaManager = $this->getSchemaManager();

            return in_array($databaseName, $schemaManager->listDatabases());
        } catch (Exception $exception) {
            $message = $exception->getMessage();

            $mysqlDatabaseError = str_contains($message, sprintf("Unknown database '%s'", $databaseName));
            $postgresDatabaseError = str_contains($message, sprintf('database "%s" does not exist', $databaseName));

            if ($mysqlDatabaseError || $postgresDatabaseError) {
                return false;
            }

            throw $exception;
        }
    }

    private function setupDatabase(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): array
    {
        $outputStyle = new SymfonyStyle($input, $output);
        $outputStyle->writeln('It appears that your database already exists.');
        $outputStyle->writeln('<error>Warning! This action will erase your database.</error>');

        $question = new ConfirmationQuestion('Would you like to reset it? (y/N) ', false);
        if ($questionHelper->ask($input, $output, $question)) {
            return [
                'doctrine:database:drop' => ['--force' => true],
                'doctrine:database:create',
                'doctrine:migrations:migrate' => ['--no-interaction' => true],
            ];
        }

        if (!$this->isSchemaPresent()) {
            return ['doctrine:migrations:migrate' => ['--no-interaction' => true]];
        }

        $outputStyle->writeln('Seems like your database contains schema.');
        $outputStyle->writeln('<error>Warning! This action will erase your database.</error>');
        $question = new ConfirmationQuestion('Do you want to reset it? (y/N) ', false);
        if ($questionHelper->ask($input, $output, $question)) {
            return [
                'doctrine:schema:drop' => ['--force' => true],
                'doctrine:migrations:migrate' => ['--no-interaction' => true],
            ];
        }

        return [];
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    private function isSchemaPresent(): bool
    {
        try {
            return 0 !== count($this->getSchemaManager()->listTableNames());
        } catch (\Doctrine\DBAL\Exception $e) {
        }
    }

    /** @noinspection PhpInconsistentReturnPointsInspection */
    private function getDatabaseName(): string
    {
        try {
            return $this->entityManager->getConnection()->getDatabase();
        } catch (\Doctrine\DBAL\Exception $e) {
        }
    }

    private function getSchemaManager(): AbstractSchemaManager
    {
        $connection = $this->entityManager->getConnection();

        if (method_exists($connection, 'createSchemaManager')) {
            try {
                return $connection->createSchemaManager();
            } catch (\Doctrine\DBAL\Exception $e) {
            }
        }

        if (method_exists($connection, 'getSchemaManager')) {
            try {
                return $connection->createSchemaManager();
            } catch (\Doctrine\DBAL\Exception $e) {
            }
        }

        throw new RuntimeException('Unable to get schema manager.');
    }


}

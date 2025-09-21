<?php

namespace App\Service\Setup;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\SchemaManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

final class DatabaseSetupCommandsProvider
{
    public function __construct(
        private readonly ManagerRegistry $doctrineRegistry,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function getCommands(InputInterface $input, OutputInterface $output, QuestionHelper $questionHelper): array
    {
        if (!$this->isDatabasePresent()) {
            $this->logger->info('Database not found, will create and migrate.');
            return [
                'doctrine:database:create'    => [],
                'doctrine:migrations:migrate' => ['--no-interaction' => true],
            ];
        }

        $this->logger->info('Database exists, running setup process.');

        return array_merge(
            $this->setupDatabase($input, $output, $questionHelper),
            [
                'doctrine:migrations:version' => [
                    '--add'            => true,
                    '--all'            => true,
                    '--no-interaction' => true,
                ],
            ]
        );
    }

    private function isDatabasePresent(): bool
    {
        $databaseName = $this->getDatabaseName();

        try {
            $schemaManager = $this->getSchemaManager();
            return in_array($databaseName, $schemaManager->listDatabases(), true);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();

            $mysqlDatabaseError    = str_contains($message, sprintf("Unknown database '%s'", $databaseName));
            $postgresDatabaseError = str_contains($message, sprintf('database "%s" does not exist', $databaseName));

            if ($mysqlDatabaseError || $postgresDatabaseError) {
                $this->logger->warning(sprintf('Database "%s" not found.', $databaseName));
                return false;
            }

            $this->logger->error('Unexpected error while checking database presence.', [
                'exception' => $exception,
            ]);
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
            $this->logger->notice('User confirmed full database reset.');
            return [
                'doctrine:database:drop'      => ['--force' => true],
                'doctrine:database:create'    => [],
                'doctrine:migrations:migrate' => ['--no-interaction' => true],
            ];
        }

        try {
            if (!$this->isSchemaPresent()) {
                $this->logger->warning('Schema missing, will run migrations.');
                return ['doctrine:migrations:migrate' => ['--no-interaction' => true]];
            }
        } catch (Exception $e) {
            $this->logger->error('Error while checking schema presence.', [
                'exception' => $e,
            ]);
            return [];
        }

        $outputStyle->writeln('Seems like your database contains schema.');
        $outputStyle->writeln('<error>Warning! This action will erase your database.</error>');
        $question = new ConfirmationQuestion('Do you want to reset it? (y/N) ', false);
        if ($questionHelper->ask($input, $output, $question)) {
            $this->logger->notice('User confirmed schema reset.');
            return [
                'doctrine:schema:drop'        => ['--force' => true],
                'doctrine:migrations:migrate' => ['--no-interaction' => true],
            ];
        }

        $this->logger->info('User declined schema reset.');
        return [];
    }

    private function isSchemaPresent(): bool
    {
        try {
            return count($this->getSchemaManager()->listTableNames()) > 0;
        } catch (Exception $e) {
            $this->logger->error('Error while listing tables.', [
                'exception' => $e,
            ]);
            return false;
        }
    }

    private function getDatabaseName(): string
    {
        return $this->getEntityManager()->getConnection()->getDatabase();
    }

    private function getSchemaManager(): SchemaManager|AbstractSchemaManager
    {
        $connection = $this->getEntityManager()->getConnection();

        if (method_exists($connection, 'createSchemaManager')) {
            return $connection->createSchemaManager();
        }

        $this->logger->critical('Unable to get schema manager. Doctrine DBAL is too old.');
        throw new RuntimeException('Unable to get schema manager. Upgrade Doctrine DBAL.');
    }

    private function getEntityManager(): EntityManagerInterface
    {
        return $this->doctrineRegistry->getManager();
    }
}

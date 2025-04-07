<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function count;
use function is_string;

class CommandRunner extends Command
{
    protected CommandExecutor $commandExecutor;

    protected static $defaultName = 'command-runner';

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $application = $this->getApplication();
        $application->setCatchExceptions(false);

        $this->commandExecutor = new CommandExecutor($input, $output, $application);
    }

    /**
     * @throws Exception
     */
    protected function go(array $commands, OutputInterface $output, bool $displayProgress = true): void
    {
        $progress = $this->createProgressBar($displayProgress ? $output : new NullOutput(), count($commands));

        foreach ($commands as $key => $value) {
            if (is_string($key)) {
                $command = $key;
                $parameter = $value;
            } else {
                $command = $value;
                $parameter = [];
            }

            $this->commandExecutor->runCommand($command, $parameter);

            // PDO does not always close the connection after Doctrine commands.
            // See https://github.com/symfony/symfony/issues/11750.
            /** @var EntityManagerInterface $entityManager */
            $entityManager = $this->getApplication()->get('doctrine')->getManager();
            $entityManager->getConnection()->close();

            $progress->advance();
        }

        $progress->finish();
    }

    protected function createProgressBar(OutputInterface $output, int $length = 10): ProgressBar
    {
        $progress = new ProgressBar($output);
        $progress->setBarCharacter('<info>░</info>');
        $progress->setEmptyBarCharacter(' ');
        $progress->setProgressCharacter('<comment>░</comment>');

        $progress->start($length);

        return $progress;
    }
}

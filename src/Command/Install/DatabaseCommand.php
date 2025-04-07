<?php

namespace App\Command\Install;

use Exception;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @property $commandExecutor
 */
final class DatabaseCommand
{
    protected static string $defaultName = 'install:database';

    protected function configure(): void
    {
        $this
            ->setDescription('Install database.')
            ->setHelp(
                <<<'EOT'
The <info>%command.name%</info> command creates database.
EOT
            )
            ->addOption('fixture-suite', 's', InputOption::VALUE_OPTIONAL, 'Load specified fixture suite during install', null);
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $suite = $input->getOption('fixture-suite');

        $outputStyle = new SymfonyStyle($input, $output);
        $outputStyle->writeln(sprintf(
            'Creating Sylius database for environment <info>%s</info>.',
            $this->getEnvironment(),
        ));

        $commands = $this
            ->getApplication()
            ->get('commands_provider.database_setup')
            ->getCommands($input, $output, $this->getHelper('question'));

        $this->runCommands($commands, $output);
        $outputStyle->newLine();

        $parameters = [];
        if (null !== $suite) {
            $parameters['--fixture-suite'] = $suite;
        }
        $this->commandExecutor->runCommand('install:sample-data', $parameters, $output);

        return 0;
    }
}

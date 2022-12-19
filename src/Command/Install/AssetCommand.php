<?php

namespace App\Command\Install;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AssetCommand extends Command
{
    protected static $defaultName = 'install:asset';

    protected function configure(): void
    {
        $this
            ->setDescription('Installs all assets.')
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command downloads and installs all Sylius media assets.
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $environment = $this->getApplication()->get('kernel.environment');

        $output->writeln(sprintf(
            'Installing assets for environment <info>%s</info>.',
            $environment,
        ));


        try {
            $publicDir = $this->getApplication()->get('core.public_dir');

            $this->directoryChecker($publicDir, $output);
            $this->directoryChecker($publicDir . '/bundles/', $output);
        } catch (\RuntimeException $exception) {
            $output->writeln($exception->getMessage());

            return 1;
        }

        $commands = [
            'asset:install' => ['target' => $publicDir],
        ];

//        $this->runCommands($commands, $output); //TODO autowire service/command/ commandRunner

        return 0;
    }

    protected function directoryChecker(string $directory, OutputInterface $output): void
    {
        $checker = $this->getApplication()->get('directory_checker');
        $checker->setCommandName($this->getName());

        $checker->ensureDirectoryExists($directory, $output);
        $checker->ensureDirectoryIsWritable($directory, $output);
    }
}

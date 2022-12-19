<?php

namespace App\Command\Install;

use App\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AssetCommand extends AbstractCommand
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
        $output->writeln(sprintf(
            'Installing asset for environment <info>%s</info>.',
            $this->getEnvironment(),
        ));

        try {
            $publicDir = $this->getContainer()->getParameter('core.public_dir');

            $this->ensureDirectoryExistsAndIsWritable($publicDir . '/assets/', $output);
            $this->ensureDirectoryExistsAndIsWritable($publicDir . '/bundles/', $output);
        } catch (\RuntimeException $exception) {
            $output->writeln($exception->getMessage());

            return 1;
        }

        $commands = [
            'asset:install' => ['target' => $publicDir],
        ];

        $this->runCommands($commands, $output);

        return 0;
    }
}

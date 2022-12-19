<?php

namespace App\Command\Install;

use App\Command\AbstractCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Process\Exception\RuntimeException;

final class Command extends AbstractCommand
{
    protected static $defaultName = 'install';

    private array $commands = [
        [
            'command' => 'check-requirements',
            'message' => 'Checking system requirements.',
        ],
        [
            'command' => 'database',
            'message' => 'Setting up the database.',
        ],
        [
            'command' => 'setup',
            'message' => 'Shop configuration.',
        ],
        [
            'command' => 'jwt-setup',
            'message' => 'Configuring JWT token.',
        ],
        [
            'command' => 'assets',
            'message' => 'Installing assets.',
        ],
    ];

    protected function configure(): void
    {
        $this
            ->setDescription('Installs in your preferred environment.')
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command installs Sylius.
EOT
            )
            ->addOption('fixture-suite', 's', InputOption::VALUE_OPTIONAL, 'Load specified fixture suite during install', null)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $suite = $input->getOption('fixture-suite');

        $outputStyle = new SymfonyStyle($input, $output);
        $outputStyle->writeln('<info>Installing ...</info>');
        $outputStyle->writeln($this->getConsoleLogo());

        $this->ensureDirectoryExistsAndIsWritable((string) $this->getContainer()->getParameter('kernel.cache_dir'), $output);

        $errored = false;
        /**
         * @var int $step
         * @var array $command
         */
        foreach ($this->commands as $step => $command) {
            try {
                $outputStyle->newLine();
                $outputStyle->section(sprintf(
                    'Step %d of %d. <info>%s</info>',
                    $step + 1,
                    count($this->commands),
                    $command['message'],
                ));

                $parameters = [];
                if ('database' === $command['command'] && null !== $suite) {
                    $parameters['--fixture-suite'] = $suite;
                }

                $this->commandExecutor->runCommand('install:' . $command['command'], $parameters, $output);
            } catch (RuntimeException) {
                $errored = true;
            }
        }

        $outputStyle->newLine(2);
        $outputStyle->success($this->getProperFinalMessage($errored));
        $outputStyle->writeln('You can now open your store at the following path under the website root: /');

        return $errored ? 1 : 0;
    }

    private function getProperFinalMessage(bool $errored): string
    {
        if ($errored) {
            return 'iSponsor has been installed, but some error occurred.';
        }

        return 'Platform has been successfully installed.';
    }

    private function getConsoleLogo(): string
    {
        return '...iSponsor!';
    }
}

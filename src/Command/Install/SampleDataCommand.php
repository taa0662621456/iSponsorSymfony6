<?php

namespace App\Command\Install;

use App\Command\AbstractCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

final class SampleDataCommand extends AbstractCommand
{
    protected static $defaultName = 'install:sample-data';

    protected function configure(): void
    {
        $this
            ->setDescription('Install sample data into...')
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command loads the sample data.
EOT
            )
            ->addOption('fixture-suite', 's', InputOption::VALUE_OPTIONAL, 'Load specified fixture suite during install', null)
        ;
    }

    /**
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $suite = $input->getOption('fixture-suite');

        $outputStyle = new SymfonyStyle($input, $output);
        $outputStyle->newLine();
        $outputStyle->writeln(sprintf(
            'Loading sample data for environment <info>%s</info> from suite <info>%s</info>.',
            $this->getEnvironment(),
            $suite ?? 'default',
        ));
        $outputStyle->writeln('<error>Warning! This action will erase your database.</error>');

        if (!$questionHelper->ask($input, $output, new ConfirmationQuestion('Continue? (y/N) ', null !== $suite))) {
            $outputStyle->writeln('Cancelled loading sample data.');

            return 0;
        }

        try {
            $publicDir = $this->get('core.public_dir');

            $this->ensureDirectoryExistsAndIsWritable($publicDir . '/media/', $output);
            $this->ensureDirectoryExistsAndIsWritable($publicDir . '/media/image/', $output);
        } catch (\RuntimeException $exception) {
            $outputStyle->writeln($exception->getMessage());

            return 1;
        }

        $parameters = [
            'suite' => $suite,
            '--no-interaction' => true,
        ];

        $commands = [
            'sylius:fixtures:load' => $parameters,
        ];

        $this->runCommands($commands, $output);
        $outputStyle->newLine(2);

        return 0;
    }
}

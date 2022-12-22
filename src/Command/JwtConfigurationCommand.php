<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Webmozart\Assert\Assert;

final class JwtConfigurationCommand extends Command
{
    protected static $defaultName = 'install:jwt-setup';

    protected function configure(): void
    {
        $this
            ->setDescription('Setup JWT token')
            ->setHelp(
                <<<EOT
The <info>%command.name%</info> command generates JWT token.
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var HelperInterface $helper */
        $helper = $this->getHelper('question');

        $output->writeln('Generating JWT token for API');

        $question = new ConfirmationQuestion('Do you want to generate JWT token? (y/N)', false);

        Assert::isInstanceOf($helper, QuestionHelper::class);
        if (!$helper->ask($input, $output, $question)) {
            return 0;
        }

        $this->commandExecutor->runCommand('lexik:jwt:generate-keypair', ['--overwrite' => true], $output);

        $output->writeln('Please, remember to enable Platform API');
        $output->writeln('https://docs.sylius.com/en/1.10/book/api/introduction.html');

        return 0;
    }
}
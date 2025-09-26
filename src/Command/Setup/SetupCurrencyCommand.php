<?php
namespace App\Command\Setup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class SetupCurrencyCommand extends AbstractSetupCommand {
    protected static $defaultName = 'app:setup:currency';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Currencies setup completed.');
        return Command::SUCCESS;
    }
}
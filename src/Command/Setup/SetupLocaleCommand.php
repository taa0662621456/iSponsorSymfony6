<?php
namespace App\Command\Setup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class SetupLocaleCommand extends AbstractSetupCommand {
    protected static $defaultName = 'app:setup:locale';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Locales setup completed.');
        return Command::SUCCESS;
    }
}

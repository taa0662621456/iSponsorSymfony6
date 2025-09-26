<?php
namespace App\Command\Setup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class SetupVendorCommand extends AbstractSetupCommand {
    protected static $defaultName = 'app:setup:vendor';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Vendors setup completed.');
        return Command::SUCCESS;
    }
}
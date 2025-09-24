<?php
namespace App\Command\Setup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class SetupRoleCommand extends AbstractSetupCommand {
    protected static $defaultName = 'app:setup:role';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Roles setup completed.');
        return Command::SUCCESS;
    }
}
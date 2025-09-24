<?php
namespace App\Command\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserAssignRoleCommand extends Command {
    protected static $defaultName = 'app:user:assign-role';
    protected function configure() {
        $this->addArgument('email', InputArgument::REQUIRED);
        $this->addArgument('role', InputArgument::REQUIRED);
    }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("User ".$in->getArgument('email')." assigned role ".$in->getArgument('role'));
        return Command::SUCCESS;
    }
}

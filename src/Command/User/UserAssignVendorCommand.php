<?php
namespace App\Command\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserAssignVendorCommand extends Command {
    protected static $defaultName = 'app:user:assign-vendor';
    protected function configure() {
        $this->addArgument('email', InputArgument::REQUIRED);
        $this->addArgument('vendorId', InputArgument::REQUIRED);
    }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("User ".$in->getArgument('email')." assigned to vendor ".$in->getArgument('vendorId'));
        return Command::SUCCESS;
    }
}
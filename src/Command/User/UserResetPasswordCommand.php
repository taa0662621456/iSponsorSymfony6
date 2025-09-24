<?php
namespace App\Command\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserResetPasswordCommand extends Command {
    protected static $defaultName = 'app:user:reset-password';
    protected function configure() { $this->addArgument('email', InputArgument::REQUIRED); }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Password reset for ".$in->getArgument('email'));
        return Command::SUCCESS;
    }
}
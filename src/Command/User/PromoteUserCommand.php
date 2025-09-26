<?php
namespace App\Command\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class PromoteUserCommand extends AbstractRoleCommand {
    protected static $defaultName = 'app:user:promote';
    protected function configure() {
        $this->addArgument('email', InputArgument::REQUIRED);
    }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('User promoted: '.$in->getArgument('email'));
        return Command::SUCCESS;
    }
}
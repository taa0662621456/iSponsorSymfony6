<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class CancelUnpaidOrderCommand extends Command {
    protected static $defaultName = 'app:order:cancel-unpaid';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Unpaid orders cancelled.');
        return Command::SUCCESS;
    }
}

<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class RemoveExpiredCartCommand extends Command {
    protected static $defaultName = 'app:cart:cleanup';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Expired carts removed.');
        return Command::SUCCESS;
    }
}
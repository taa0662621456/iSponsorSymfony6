<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderShipCommand extends Command {
    protected static $defaultName = 'app:order:ship';
    protected function configure() { $this->addArgument('orderId', InputArgument::REQUIRED); }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Order ".$in->getArgument('orderId')." marked as shipped.");
        return Command::SUCCESS;
    }
}
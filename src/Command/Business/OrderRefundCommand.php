<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class OrderRefundCommand extends Command {
    protected static $defaultName = 'app:order:refund';
    protected function configure() { $this->addArgument('orderId', InputArgument::REQUIRED); }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Order ".$in->getArgument('orderId')." refunded.");
        return Command::SUCCESS;
    }
}

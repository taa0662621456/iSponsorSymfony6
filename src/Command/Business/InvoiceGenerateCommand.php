<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InvoiceGenerateCommand extends Command {
    protected static $defaultName = 'app:invoice:generate';
    protected function configure() { $this->addArgument('orderId', InputArgument::REQUIRED); }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Invoice generated for order ".$in->getArgument('orderId'));
        return Command::SUCCESS;
    }
}
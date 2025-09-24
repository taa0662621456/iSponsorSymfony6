<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PaymentRetryCommand extends Command {
    protected static $defaultName = 'app:payment:retry';
    protected function configure() { $this->addArgument('paymentId', InputArgument::REQUIRED); }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Retrying payment ".$in->getArgument('paymentId'));
        return Command::SUCCESS;
    }
}

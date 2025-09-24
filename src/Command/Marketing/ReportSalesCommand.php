<?php
namespace App\Command\Marketing;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReportSalesCommand extends Command {
    protected static $defaultName = 'app:report:sales';
    protected function configure() {
        $this->addOption('period', null, InputOption::VALUE_REQUIRED, 'Period (daily, monthly)');
    }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Sales report for period: ".$in->getOption('period'));
        return Command::SUCCESS;
    }
}
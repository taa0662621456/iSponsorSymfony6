<?php
namespace App\Command\System;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SystemCleanupCommand extends Command {
    protected static $defaultName = 'app:system:cleanup';
    protected function configure() {
        $this->addOption('days', null, InputOption::VALUE_REQUIRED, 'Remove data older than N days', 30);
    }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("System cleanup: removing data older than ".$in->getOption('days')." days.");
        return Command::SUCCESS;
    }
}

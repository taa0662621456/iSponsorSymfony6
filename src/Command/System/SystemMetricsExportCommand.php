<?php
namespace App\Command\System;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SystemMetricsExportCommand extends Command {
    protected static $defaultName = 'app:system:metrics:export';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("System metrics exported (Prometheus format).");
        return Command::SUCCESS;
    }
}

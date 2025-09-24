<?php
namespace App\Command\System;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SystemHealthcheckCommand extends Command {
    protected static $defaultName = 'app:system:healthcheck';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("System healthcheck OK.");
        return Command::SUCCESS;
    }
}

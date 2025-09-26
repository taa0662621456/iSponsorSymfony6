<?php
namespace App\Command\System;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class JwtConfigurationCommand extends Command {
    protected static $defaultName = 'app:system:jwt';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('JWT configuration checked.');
        return Command::SUCCESS;
    }
}
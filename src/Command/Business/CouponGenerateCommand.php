<?php
namespace App\Command\Business;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class CouponGenerateCommand extends Command {
    protected static $defaultName = 'app:coupon:generate';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Coupon generated.');
        return Command::SUCCESS;
    }
}
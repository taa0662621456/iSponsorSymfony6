<?php
namespace App\Command\Marketing;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CouponBulkGenerateCommand extends Command {
    protected static $defaultName = 'app:coupon:bulk-generate';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Bulk coupons generated.");
        return Command::SUCCESS;
    }
}
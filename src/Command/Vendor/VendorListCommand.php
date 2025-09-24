<?php
namespace App\Command\Vendor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class VendorListCommand extends AbstractVendorCommand {
    protected static $defaultName = 'app:vendor:list';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Vendors listed.');
        return Command::SUCCESS;
    }
}

<?php
namespace App\Command\Vendor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class AddVendorCommand extends AbstractVendorCommand {
    protected static $defaultName = 'app:vendor:add';
    protected function configure() {
        $this->addArgument('name', InputArgument::REQUIRED);
    }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Vendor added: '.$in->getArgument('name'));
        return Command::SUCCESS;
    }
}

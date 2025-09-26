<?php
namespace App\Command\Marketing;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PromotionExpireCommand extends Command {
    protected static $defaultName = 'app:promotion:expire';
    protected function configure() { $this->addArgument('promotionId', InputArgument::REQUIRED); }
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln("Promotion ".$in->getArgument('promotionId')." expired.");
        return Command::SUCCESS;
    }
}
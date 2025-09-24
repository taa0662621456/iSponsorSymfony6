<?php
namespace App\Command\Setup;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class SetupCategoryCommand extends AbstractSetupCommand {
    protected static $defaultName = 'app:setup:category';
    protected function execute(InputInterface $in, OutputInterface $out): int {
        $out->writeln('Categories setup completed.');
        return Command::SUCCESS;
    }
}
<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateAllCommand extends Command
{
    protected static $defaultName = 'app:generate-all';

    protected function configure()
    {
        $this
            ->setDescription('Generate and Update Schema DB and Fixtures')
            ->addArgument('update', InputArgument::OPTIONAL, 'Update All (Schema and Fixtures')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $update = $input->getArgument('update');

        if ($update) {
            $io->note(sprintf('You passed an argument: %s', $update));

        }

        // TODO: код по генерации таблицы в базе данных и в случае успеха return Command::SUCCESS;
        // в случае неуспеха return Command::FAILURE;
        // в случае неправильных параметров или аргументов return Command::INVALID
        // хелп https://symfony.com/doc/current/console.html

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
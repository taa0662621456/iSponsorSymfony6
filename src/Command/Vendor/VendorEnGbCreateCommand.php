<?php

namespace App\Command\Vendor;

use App\Factory\Vendor\VendorEnUsFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'add-vendor', description: 'Add a titles for your command')]
class VendorEnGbCreateCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('firstTitle', InputArgument::REQUIRED, 'Vendor first title/first name')
            ->addArgument('lastTitle', InputArgument::REQUIRED, 'Vendor last title/last name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $firstTitle = $input->getArgument('title');

        if ($firstTitle) {
            $io->note(sprintf('First title/first name: %s', $firstTitle));
        }

        $lastTitle = $input->getArgument('lastTitle');

        if ($lastTitle) {
            $io->note(sprintf('Content: %s', $lastTitle));
        }

        $vendorEnUs = VendorEnUsFactory::createVendorEnUsEntity($firstTitle, $lastTitle);
        $this->manager->persist($vendorEnUs);
        $this->manager->flush();

        $io->success('Vendor is saved: '.$vendorEnUs);

        return Command::SUCCESS;
    }
}

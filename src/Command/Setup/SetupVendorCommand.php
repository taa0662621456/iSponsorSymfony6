<?php

namespace App\Command\Setup;


use App\Entity\Role\Role;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupVendorCommand extends Command
{
    protected static $defaultName = 'setup.vendor';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->vendorEntity($input, $output);

        return 0;
    }


    public function VendorEntity(InputInterface $input, OutputInterface $output)
    {
        $outputStyle = new SymfonyStyle($input, $output);

        $outputStyle->writeln('Create VendorEntity.');

        $vendor = new Role();

        $vendor->setSlug('vendor');

//        $manager = ObjectManager::class; //TODO autowire ObjectManager
//        $manager->persist($vendor);
//        $manager->flush($vendor);

    }
}

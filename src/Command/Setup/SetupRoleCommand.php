<?php

namespace App\Command\Setup;

use App\Entity\Role\Role;
use App\Entity\Vendor\Vendor;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupRoleCommand extends Command
{
    protected static $defaultName = 'setup.role';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->roleEntity($input, $output);

        return 0;
    }

    public function roleEntity(InputInterface $input, OutputInterface $output)
    {
        $outputStyle = new SymfonyStyle($input, $output);

        $outputStyle->writeln('Create VendorEntity.');

        $role = new Role();

        $role->setSlug('user');

//        $manager = ObjectManager::class; //TODO autowire ObjectManager
//        $manager->persist($role);
//        $manager->flush($role);

    }
}

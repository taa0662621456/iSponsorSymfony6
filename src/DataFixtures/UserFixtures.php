<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const ADMIN_REF = 'user_admin';
    public const MANAGER_REF = 'user_manager';
    public const CUSTOMER_REF = 'user_customer';

    public function load(ObjectManager $manager): void
    {
        $admin = new Vendor();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->addReference(self::ADMIN_REF, $admin);

        $managerUser = new Vendor();
        $managerUser->setEmail('manager@example.com');
        $managerUser->setRoles(['ROLE_MANAGER']);
        $manager->persist($managerUser);
        $this->addReference(self::MANAGER_REF, $managerUser);

        $customer = new Vendor();
        $customer->setEmail('customer@example.com');
        $customer->setRoles(['ROLE_CUSTOMER']);
        $manager->persist($customer);
        $this->addReference(self::CUSTOMER_REF, $customer);

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorSecurity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VendorSecurityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $vendorSecurity = new VendorSecurity();
            #
            $vendorSecurity->setEmail($faker->email);
            #
            $vendorSecurity->setLocale($faker->locale);
            $vendorSecurity->setPassword($faker->password(8,12));
            $vendorSecurity->setPhone($faker->phoneNumber);
            $vendorSecurity->setPublished(true);
            $vendorSecurity->setRoles(['ROLE_USER']);
            #
            $manager->persist($vendorSecurity);

            $this->addReference('vendorSecurity_' . $i, $vendorSecurity);
        }
        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            BaseEmptyFixtures::class,
            #
            VendorMediaFixtures::class,
            VendorDocumentFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 4;
    }


    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}

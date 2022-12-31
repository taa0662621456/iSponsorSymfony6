<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorIban;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class VendorIbanFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $vendorIban = new VendorIban();
            #
            $vendorIban->setFirstTitle($faker->company);
            $vendorIban->setIban('32323231551351321546563132');
            #
            $manager->persist($vendorIban);
            #
            $this->addReference('vendorIban_' . $i, $vendorIban);
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
            VendorSecurityFixtures::class,

        ];
    }

    public function getOrder(): int
    {
        return 5;
    }


    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}

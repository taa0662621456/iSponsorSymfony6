<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorIban;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VendorIbanFixtures extends Fixture implements DependentFixtureInterface
{
    public const VENDOR_IBAN_COLLECTION = 'vendorIbanCollection';

    public function load(ObjectManager $manager)
    {
        $vendorIbanCollection = new ArrayCollection();

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $vendorIban = new VendorIban();
            #
            $vendorIban->setFirstTitle($faker->company);
            $vendorIban->setIban('32323231551351321546563132');
            #
            $manager->persist($vendorIban);
            $manager->flush();
            #
            $vendorIbanCollection->add($vendorIban);
        }

        $this->addReference(self::VENDOR_IBAN_COLLECTION, $vendorIbanCollection);
    }

    public function getDependencies(): array
    {
        return [
            VendorDocumentFixtures::class,
            VendorEnGbFixtures::class,

        ];
    }

    public function getOrder(): int
    {
        return 3;
    }


    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}

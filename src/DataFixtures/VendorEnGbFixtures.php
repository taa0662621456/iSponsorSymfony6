<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorEnGb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VendorEnGbFixtures extends Fixture implements DependentFixtureInterface
{
    public const VENDOR_ENGB_COLLECTION = 'vendorEnGbCollection';



    public function load(ObjectManager $manager)
    {
        $vendorEnGbCollection = new ArrayCollection();

        $faker = Factory::create();


        for ($i = 0; $i < 20; $i++){

            $vendorEnGb = new VendorEnGb();
            #
            $vendorEnGb->setFirstTitle($faker->firstName);
            $vendorEnGb->setLastTitle($faker->lastName);
            #
            $vendorEnGb->setVendorAddress($faker->streetAddress);
            $vendorEnGb->setVendorZip((int)$faker->postcode);
            $vendorEnGb->setVendorCity($faker->city);
            $vendorEnGb->setVendorAddressSecond($faker->streetAddress);
            $vendorEnGb->setVendorStateId((int)$faker->countryCode);
            #
            $vendorEnGb->setVendorPhone($faker->phoneNumber);
            $vendorEnGb->setVendorSecondPhone($faker->phoneNumber);
            #
            $vendorEnGb->setVendorCurrency($faker->currencyCode);
            #
            $manager->persist($vendorEnGb);
            $manager->flush();
            #
            $vendorEnGbCollection->add($vendorEnGb);
        }

        $this->addReference(self::VENDOR_ENGB_COLLECTION, $vendorEnGbCollection);
    }

    public function getDependencies(): array
    {
        return [
            VendorDocumentFixtures::class,
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

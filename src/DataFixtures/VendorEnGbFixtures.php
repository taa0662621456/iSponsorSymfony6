<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorEnUS;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class VendorEnGbFixtures extends AbstractDataFixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++){

            $vendorEnGb = new VendorEnUS();
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
            #
            $this->addReference('vendorEnGb_' . $i, $vendorEnGb);
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
            VendorIbanFixtures::class,
        ];
    }

    public function getOrder(): int
    {
        return 6;
    }

    /**
     * @return string[]
     */
    public static function getGroups(): array
    {
        return ['vendor'];
    }

}

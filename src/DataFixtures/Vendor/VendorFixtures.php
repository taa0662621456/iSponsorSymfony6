<?php

namespace App\DataFixtures;

use App\Entity\Vendor\Vendor;
use App\Service\BaseGroupedFixture;
use App\Service\ThisPersonDoesNotExistPhotoConsumer;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class VendorFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $vendorMedia    = $this->getReference('vendorMedia_' . $i);
            $vendorDocument = $this->getReference('vendorDocument_' . $i);
            $vendorEnGb     = $this->getReference('vendorEnGb_' . $i);
            $vendorIban     = $this->getReference('vendorIban_' . $i);
            $vendorSecurity = $this->getReference('vendorSecurity_' . $i);

            $personPhoto = new ThisPersonDoesNotExistPhotoConsumer();
            $randName = random_int(1000000, 1000000000);
            $personPhoto->getExitPersonPhoto((string) $randName);

            $vendor = new Vendor();
            $vendor->setVendorIban($vendorIban);
            $vendor->setVendorEnGb($vendorEnGb);
            $vendor->setVendorSecurity($vendorSecurity);

            $manager->persist($vendor);

            $this->addReference('vendor_' . $i, $vendor);
        }

        $manager->flush();
    }

    public static function getGroup(): string
    {
        return 'vendor';
    }

    public static function getPriority(): int
    {
        return 100;
    }
}
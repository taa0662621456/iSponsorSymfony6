<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorEnGb;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class VendorEnGbFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $enGb = new VendorEnGb();
            // Example: English vendor name
            $enGb->setName("Vendor $i Ltd.");

            $manager->persist($enGb);
            $this->addReference('vendorEnGb_' . $i, $enGb);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'vendor'; }
    public static function getPriority(): int { return 50; }
}

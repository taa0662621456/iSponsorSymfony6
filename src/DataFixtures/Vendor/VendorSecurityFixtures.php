<?php

namespace App\DataFixtures;

use App\Entity\Vendor\VendorSecurity;
use App\Service\BaseGroupedFixture;
use Doctrine\Persistence\ObjectManager;

final class VendorSecurityFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $sec = new VendorSecurity();
            // Example: set security token
            $sec->setToken(hash('sha256', "vendor_$i"));

            $manager->persist($sec);
            $this->addReference('vendorSecurity_' . $i, $sec);
        }

        $manager->flush();
    }

    public static function getGroup(): string { return 'vendor'; }
    public static function getPriority(): int { return 40; }
}
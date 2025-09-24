<?php

namespace App\DataFixtures\Vendor;

use App\Entity\Vendor\VendorProfile;
use App\Service\BaseGroupedFixture;

final class VendorProfileFixtures extends BaseGroupedFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $profile = new VendorProfile();
            $profile->setDescription("Vendor profile $i");

            $manager->persist($profile);
            $this->addReference('vendorProfile_' . $i, $profile);
        }
        $manager->flush();
    }

    public static function getGroup(): string { return 'vendor'; }
    public static function getPriority(): int { return 20; }
}
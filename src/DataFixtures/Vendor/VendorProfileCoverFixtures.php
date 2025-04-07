<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class VendorProfileCoverFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {

        $property = [
            'fileLayoutPosition' => 'profile_cover',
        ];

        $property = $this->imageFixtureEngine($property, '512x512');

        parent::load($manager, $property);
    }
}

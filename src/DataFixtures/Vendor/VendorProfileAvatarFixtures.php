<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use App\Service\DataFixtures\RandomImagePicker;
use Doctrine\Persistence\ObjectManager;

final class VendorProfileAvatarFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {

        $property = [
            'fileLayoutPosition' => 'profile_avatar',
        ];

        $property = $this->imageFixtureEngine($property, '512x512', '%app_vendor_profile_avatar_directory%');

        parent::load($manager, $property);
    }
}

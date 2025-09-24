<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class VendorMediaAttachmentFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {

        $property = [
            'firstTitle' => fn($faker, $i) => $faker->realText(),
            'lastTitle' => fn($faker, $i) => $faker->realText(7000),
            'fileLayoutPosition' => 'profile_avatar',
        ];

        parent::load($manager, $property);
    }
}
<?php

namespace App\DataFixtures\Vendor;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

use App\DataFixtures\DataFixtures;

final class VendorSecurityFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, $property = [], $n = 20): void
    {
        $faker = Factory::create();

        $property = [
            'email' => $faker->unique()->email,
        ];

        parent::load($manager, $property);
    }
}

<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class VendorEnGbFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'firstTitle' => fn($faker, $i) => $faker->firstName(),
            'lastTitle' => fn($faker, $i) => $faker->lastName(),
            'phone_number' => fn($faker, $i) => $faker->phoneNumber(),
        ];

        parent::load($manager, $property);
    }
}

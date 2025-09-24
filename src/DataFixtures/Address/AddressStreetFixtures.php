<?php

namespace App\DataFixtures\Address;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressStreetFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->streetAddress(),
        ];

        parent::load($manager, $property);
    }
}
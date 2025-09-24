<?php

namespace App\DataFixtures\Address;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressProvinceFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->city(),
            'middleTitle' => fn($faker, $i) => $faker->citySuffix(),

        ];

        parent::load($manager, $property);
    }
}
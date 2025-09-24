<?php

namespace App\DataFixtures\Address;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressBuildingTypeFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->buildingNumber() . ' ' . $faker->streetAddress(),
            'middleTitle' => fn($faker, $i) => $faker->randomNumber(),
            'lastTitle' => fn($faker, $i) => $faker->city() . ' ' . $faker->country() . ' ' . $faker->postcode(),
        ];

        parent::load($manager, $property);
    }
}
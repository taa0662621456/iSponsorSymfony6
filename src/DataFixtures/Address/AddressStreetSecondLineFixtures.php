<?php

namespace App\DataFixtures\Address;


use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressStreetSecondLineFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'middleTitle' => fn($faker, $i) => $faker->randomNumber(),
            'lastTitle' => fn($faker, $i) => $faker->city() . ' ' . $faker->country() . ' ' . $faker->companySuffix() . ' ' . $faker->postcode(),
        ];

        parent::load($manager, $property);
    }
}
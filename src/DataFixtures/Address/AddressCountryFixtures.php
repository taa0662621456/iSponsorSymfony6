<?php

namespace App\DataFixtures\Address;


use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressCountryFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->country(),
        ];

        parent::load($manager, $property);
    }
}
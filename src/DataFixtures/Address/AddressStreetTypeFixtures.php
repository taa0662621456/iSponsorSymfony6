<?php

namespace App\DataFixtures\Address;


use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressStreetTypeFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'firstTitle' => fn($faker, $i) => $faker->streetSuffix(),
        ];

        parent::load($manager, $property);
    }
}

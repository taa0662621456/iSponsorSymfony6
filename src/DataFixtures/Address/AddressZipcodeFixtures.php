<?php

namespace App\DataFixtures\Address;


use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressZipcodeFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'lastTitle' => fn($faker, $i) => $faker->postcode(),
        ];

        parent::load($manager, $property);
    }
}

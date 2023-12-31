<?php

namespace App\DataFixtures\Address;

use Faker\Factory;

use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class AddressBuildingTypeFixtures extends DataFixtures
{
    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 2): void
    {
        $faker = Factory::create();

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
        ];

        parent::load($manager, $property);
    }
}

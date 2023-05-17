<?php

namespace App\DataFixtures\Address;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


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

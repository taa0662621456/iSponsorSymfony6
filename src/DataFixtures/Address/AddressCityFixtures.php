<?php

namespace App\DataFixtures\Address;



use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;

use JetBrains\PhpStorm\NoReturn;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


final class AddressCityFixtures extends DataFixtures
{

    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
        ];

        parent::load($manager, $property, $n);
    }

}

<?php

namespace App\DataFixtures\Vendor;


use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;


use App\Entity\Vendor\Vendor;
use App\Service\ThisPersonDoesNotExistPhotoConsumer;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class VendorFixtures extends DataFixtures
{

    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [];

        $i = 1;

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
        ];

        parent::load($manager, $property, $n);
    }

}


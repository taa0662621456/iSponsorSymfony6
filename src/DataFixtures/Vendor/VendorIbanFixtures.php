<?php

namespace App\DataFixtures\Vendor;


use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;


use App\Entity\Vendor\VendorIban;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

final class VendorIbanFixtures extends DataFixtures
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

/*    public function getDependencies(): array
    {
        return [

            VendorMediaFixture::class,
            VendorDocumentFixture::class,
            VendorSecurityFixture::class,

        ];
    }*/


}

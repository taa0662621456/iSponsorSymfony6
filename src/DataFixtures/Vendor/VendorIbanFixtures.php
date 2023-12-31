<?php

namespace App\DataFixtures\Vendor;


use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;

final class VendorIbanFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {


        $property = [
            'iban' => fn($faker, $i) => $faker->iban(),
            'lastTitle' => fn($faker, $i) => $faker->country(),
        ];

        parent::load($manager, $property);
    }

}

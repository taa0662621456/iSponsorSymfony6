<?php

namespace App\DataFixtures\Zone;


use Webmozart\Assert\Assert;

use JetBrains\PhpStorm\NoReturn;
use App\DataFixtures\DataFixtures;
use Symfony\Component\Intl\Countries;
use Doctrine\Persistence\ObjectManager;
use App\FactoryInterface\Zone\ZoneFactoryInterface;
use App\EntityInterface\Address\AddressCountryInterface;
use App\EntityInterface\Address\AddressProvinceInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ZoneFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {
        $property = [
            'firstTitle' => fn($faker, $i) => $faker->realText(),
            'lastTitle' => fn($faker, $i) => $faker->realText(7000),
            'zipZone' => fn($faker, $i) => $faker->randomDigitNotZero() . '-' . $faker->randomDigitNotZero()
        ];

        parent::load($manager, $property);
    }
}

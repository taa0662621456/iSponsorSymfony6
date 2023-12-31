<?php

namespace App\DataFixtures\Product;

use Faker\Factory;

use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use App\Interface\DataFixturesInterface\DataFixturesFactoryInterface;

final class ProductAttributeFixtures extends DataFixtures
{

    public function __construct(ObjectManager $manager, array $property = [], ?int $n = self::DATA_FIXTURES)
    {
    }

}

<?php

namespace App\DataFixtures\Association;

use Faker\Generator;

use App\DataFixtures\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\EntityInterface\Product\ProductInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class AssociationProductSimilarFixtures extends DataFixtures
{
    public function load(ObjectManager $manager, ?array $property = []): void
    {

        parent::load($manager, $property);
    }

}
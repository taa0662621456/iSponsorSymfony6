<?php

namespace App\DataFixtures\Product;

use Faker\Factory;

use JetBrains\PhpStorm\NoReturn;

use App\DataFixtures\DataFixtures;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ProductReviewFixtures extends DataFixtures
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

    public function getOrder(): int
    {
        return 19;
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('title')->cannotBeEmpty()->end()
            ->scalarNode('rating')->cannotBeEmpty()->end()
            ->scalarNode('comment')->cannotBeEmpty()->end()
            ->scalarNode('author')->cannotBeEmpty()->end()
            ->scalarNode('product')->cannotBeEmpty()->end()
            ->scalarNode('status')->end();
    }
}

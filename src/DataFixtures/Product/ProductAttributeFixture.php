<?php

namespace App\DataFixtures\Product;

use App\DataFixtures\AbstractDataFixture;
use Faker\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ProductAttributeFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'product_attribute';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('name')->cannotBeEmpty()->end()
            ->scalarNode('code')->cannotBeEmpty()->end()
            ->booleanNode('translatable')->defaultTrue()->end()
            ->enumNode('type')->values(['text', 'number', 'boolean'])->cannotBeEmpty()->end()
            ->variableNode('configuration')->end()
        ;
    }

    public function load($manager): void
    {
        parent::load($manager);

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $resourceOptions = [
                'name' => $faker->word,
                'code' => $faker->unique()->word,
                'translatable' => $faker->boolean,
                'type' => $faker->randomElement(['text', 'number', 'boolean']),
                'configuration' => null,
            ];

            $resource = $this->exampleFactory->create((string) $resourceOptions);

            $this->objectManager->persist($resource);
        }

        $this->objectManager->flush();
    }
}

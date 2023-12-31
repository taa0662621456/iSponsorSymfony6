<?php

namespace App\DataFixtures\Product;

use App\DataFixtures\DataFixtures;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ProductOptionFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->arrayNode('values')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('code')
                    ->scalarPrototype()
                ->end();
    }
}

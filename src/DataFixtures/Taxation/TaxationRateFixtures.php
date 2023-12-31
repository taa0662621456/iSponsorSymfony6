<?php

namespace App\DataFixtures\Taxation;

use App\DataFixtures\DataFixtures;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class TaxationRateFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('zone')->cannotBeEmpty()->end()
                ->scalarNode('category')->cannotBeEmpty()->end()
                ->floatNode('amount')->end()
                ->booleanNode('included_in_price')->end()
                ->scalarNode('calculator')->cannotBeEmpty()->end();
    }
}

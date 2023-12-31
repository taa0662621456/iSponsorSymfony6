<?php

namespace App\DataFixtures\Taxation;

use App\DataFixtures\DataFixtures;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class TaxationCategoryFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end();
    }
}

<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class TaxonFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'taxon';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('slug')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->variableNode('translations')->cannotBeEmpty()->defaultValue([])->end()
                ->variableNode('children')->cannotBeEmpty()->defaultValue([])->end()
        ;
    }
}

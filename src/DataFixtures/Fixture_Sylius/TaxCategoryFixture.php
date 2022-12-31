<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class TaxCategoryFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'tax_category';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
        ;
    }
}

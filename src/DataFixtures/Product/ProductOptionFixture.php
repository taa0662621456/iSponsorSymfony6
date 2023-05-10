<?php


namespace App\DataFixtures\Product;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ProductOptionFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'product_option';
    }

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
                ->end()
        ;
    }
}

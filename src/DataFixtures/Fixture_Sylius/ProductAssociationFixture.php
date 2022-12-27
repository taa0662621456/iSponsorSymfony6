<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ProductAssociationFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'product_association';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('type')->cannotBeEmpty()->end()
                ->scalarNode('owner')->cannotBeEmpty()->end()
                ->variableNode('associated_products')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
        ;
    }
}

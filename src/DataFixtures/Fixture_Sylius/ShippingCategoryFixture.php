<?php


namespace App\CoreBundle\Fixture;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ShippingCategoryFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'shipping_category';
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

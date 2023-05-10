<?php


namespace App\DataFixtures\Shipment;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ShippingCategoryFixture extends AbstractDataFixture
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

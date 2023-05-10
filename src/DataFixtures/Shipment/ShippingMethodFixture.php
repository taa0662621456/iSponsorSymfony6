<?php


namespace App\DataFixtures\Shipment;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ShippingMethodFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'shipping_method';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('zone')->cannotBeEmpty()->end()
                ->booleanNode('enabled')->end()
                ->scalarNode('category')->end()
                ->variableNode('channels')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->arrayNode('calculator')
                    ->children()
                        ->scalarNode('type')->isRequired()->cannotBeEmpty()->end()
                        ->variableNode('configuration')->end()
                    ->end()
                ->end()
                ->scalarNode('tax_category')->end()
        ;
    }
}

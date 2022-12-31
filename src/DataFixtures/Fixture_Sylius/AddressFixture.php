<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class AddressFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'address';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('first_name')->cannotBeEmpty()->end()
                ->scalarNode('last_name')->cannotBeEmpty()->end()
                ->scalarNode('phone_number')->end()
                ->scalarNode('company')->end()
                ->scalarNode('street')->cannotBeEmpty()->end()
                ->scalarNode('city')->cannotBeEmpty()->end()
                ->scalarNode('postcode')->cannotBeEmpty()->end()
                ->scalarNode('country_code')->cannotBeEmpty()->end()
                ->scalarNode('province_code')->end()
                ->scalarNode('province_name')->end()
                ->scalarNode('customer')->cannotBeEmpty()->end()
        ;
    }
}

<?php


namespace App\DataFixtures\Vendor;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ShopUserFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'shop_user';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('email')->cannotBeEmpty()->end()
                ->scalarNode('first_name')->cannotBeEmpty()->end()
                ->scalarNode('last_name')->cannotBeEmpty()->end()
                ->scalarNode('gender')->end()
                ->scalarNode('phone_number')->end()
                ->scalarNode('birthday')->end()
                ->booleanNode('enabled')->end()
                ->scalarNode('password')->cannotBeEmpty()->end()
                ->scalarNode('customer_group')->end()
        ;
    }
}

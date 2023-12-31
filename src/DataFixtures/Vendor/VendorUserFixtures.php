<?php

namespace App\DataFixtures\Vendor;

use App\DataFixtures\DataFixtures;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class VendorUserFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('email')->cannotBeEmpty()->end()
                ->scalarNode('username')->cannotBeEmpty()->end()
                ->booleanNode('enabled')->end()
                ->booleanNode('api')->end()
                ->scalarNode('password')->cannotBeEmpty()->end()
                ->scalarNode('locale_code')->cannotBeEmpty()->end();
        //                ->scalarNode('first_name')->cannotBeEmpty()->end()
        //                ->scalarNode('last_name')->cannotBeEmpty()->end()
        //                ->scalarNode('avatar')->cannotBeEmpty()->end()
    }
}

<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class AdminUserFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'admin_user';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('email')->cannotBeEmpty()->end()
                ->scalarNode('username')->cannotBeEmpty()->end()
                ->booleanNode('enabled')->end()
                ->booleanNode('api')->end()
                ->scalarNode('password')->cannotBeEmpty()->end()
                ->scalarNode('locale_code')->cannotBeEmpty()->end()
                ->scalarNode('first_name')->cannotBeEmpty()->end()
                ->scalarNode('last_name')->cannotBeEmpty()->end()
                ->scalarNode('avatar')->cannotBeEmpty()->end()
        ;
    }
}

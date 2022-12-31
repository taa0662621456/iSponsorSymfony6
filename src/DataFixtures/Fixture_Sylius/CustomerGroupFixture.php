<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CustomerGroupFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'customer_group';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
        ;
    }
}

<?php


namespace App\DataFixtures\Taxation;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class TaxRateFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'tax_rate';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('zone')->cannotBeEmpty()->end()
                ->scalarNode('category')->cannotBeEmpty()->end()
                ->floatNode('amount')->end()
                ->booleanNode('included_in_price')->end()
                ->scalarNode('calculator')->cannotBeEmpty()->end()
        ;
    }
}

<?php


namespace App\DataFixtures\Shipment;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ShipmentFixtures extends DataFixtures
{
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

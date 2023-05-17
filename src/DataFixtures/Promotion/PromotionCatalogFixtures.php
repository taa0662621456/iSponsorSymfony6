<?php


namespace App\DataFixtures\Promotion;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\NoReturn;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PromotionCatalogFixtures extends DataFixtures
{

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('label')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->booleanNode('exclusive')->end()
                ->integerNode('priority')->end()
                ->scalarNode('start_date')->cannotBeEmpty()->end()
                ->scalarNode('end_date')->cannotBeEmpty()->end()
                ->variableNode('channels')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->arrayNode('scopes')
                    ->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('type')->cannotBeEmpty()->end()
                            ->scalarNode('catalogPromotion')->cannotBeEmpty()->end()
                            ->variableNode('configuration')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('actions')
                    ->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('type')->cannotBeEmpty()->end()
                            ->scalarNode('catalogPromotion')->cannotBeEmpty()->end()
                            ->variableNode('configuration')->end()
                        ->end()
                    ->end()
                ->end()
        ;
    }

}

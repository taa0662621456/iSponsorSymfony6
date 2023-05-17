<?php


namespace App\DataFixtures\Promotion;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PromotionFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->integerNode('usage_limit')->end()
                ->booleanNode('coupon_based')->end()
                ->booleanNode('exclusive')->end()
                ->integerNode('priority')->min(0)->end()
                ->variableNode('channels')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->scalarNode('starts_at')->cannotBeEmpty()->end()
                ->scalarNode('ends_at')->cannotBeEmpty()->end()
                ->arrayNode('rules')
                    ->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('type')->cannotBeEmpty()->end()
                            ->variableNode('configuration')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('actions')
                    ->requiresAtLeastOneElement()
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('type')->cannotBeEmpty()->end()
                            ->variableNode('configuration')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('coupons')->arrayPrototype()
                    ->children()
                        ->scalarNode('code')->cannotBeEmpty()->end()
                        ->scalarNode('expires_at')->defaultNull()->end()
                        ->integerNode('per_customer_usage_limit')->defaultNull()->end()
                        ->booleanNode('reusable_from_cancelled_orders')->defaultTrue()->end()
                        ->integerNode('usage_limit')->defaultNull()->end()
                    ->end()
                ->end()
        ;
    }
}

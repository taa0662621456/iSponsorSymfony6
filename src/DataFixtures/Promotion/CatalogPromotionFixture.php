<?php


namespace App\DataFixtures\Promotion;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CatalogPromotionFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'catalog_promotion';
    }

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

<?php


namespace App\DataFixtures\Fixture_Sylius;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ProductReviewFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'product_review';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('rating')->cannotBeEmpty()->end()
                ->scalarNode('comment')->cannotBeEmpty()->end()
                ->scalarNode('author')->cannotBeEmpty()->end()
                ->scalarNode('product')->cannotBeEmpty()->end()
                ->scalarNode('status')->end()
        ;
    }
}

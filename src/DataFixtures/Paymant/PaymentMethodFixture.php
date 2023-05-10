<?php


namespace App\DataFixtures\Paymant;

use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PaymentMethodFixture extends AbstractDataFixture
{
    public function getName(): string
    {
        return 'payment_method';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('instructions')->end()
                ->scalarNode('gatewayName')->cannotBeEmpty()->end()
                ->scalarNode('gatewayFactory')->cannotBeEmpty()->end()
                ->arrayNode('gatewayConfig')->variablePrototype()->end()->end()
                ->variableNode('channels')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->booleanNode('enabled')->end()
        ;
    }
}

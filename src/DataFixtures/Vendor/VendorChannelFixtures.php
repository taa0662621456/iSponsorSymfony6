<?php

namespace App\DataFixtures\Vendor;

use App\DataFixtures\DataFixtures;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class VendorChannelFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('hostname')->end()
                ->scalarNode('color')->cannotBeEmpty()->end()
                ->scalarNode('default_tax_zone')->end()
                ->scalarNode('tax_calculation_strategy')->end()
                ->booleanNode('enabled')->end()
                ->booleanNode('skipping_shipping_step_allowed')->end()
                ->booleanNode('skipping_payment_step_allowed')->end()
                ->booleanNode('account_verification_required')->end()
                ->scalarNode('default_locale')->cannotBeEmpty()->end()
                ->variableNode('locales')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->scalarNode('base_currency')->cannotBeEmpty()->end()
                ->variableNode('currencies')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->scalarNode('theme_name')->end()
                ->scalarNode('contact_email')->end()
                ->scalarNode('contact_phone_number')->end()
                ->arrayNode('shop_billing_data')
                    ->children()
                        ->scalarNode('company')->end()
                        ->scalarNode('tax_id')->end()
                        ->scalarNode('country_code')->end()
                        ->scalarNode('street')->end()
                        ->scalarNode('city')->end()
                        ->scalarNode('postcode')->end()
                    ->end()
                ->end()
                ->scalarNode('menu_taxon')->end();
    }
}

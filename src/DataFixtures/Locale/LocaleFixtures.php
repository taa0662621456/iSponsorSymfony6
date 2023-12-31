<?php

namespace App\DataFixtures\Locale;

use App\DataFixtures\DataFixtures;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class LocaleFixtures extends DataFixtures
{
    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->scalarNode('load_default_locale')->defaultTrue()->end()
            ->arrayNode('locales')->scalarPrototype()->end();
    }
}

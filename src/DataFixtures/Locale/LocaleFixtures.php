<?php

namespace App\DataFixtures\Locale;

use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\EntityInterface\Locale\LocaleInterface;
use App\Interface\DataFixturesInterface\DataFixturesFactoryInterface;
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

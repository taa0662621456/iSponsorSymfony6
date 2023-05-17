<?php

namespace App\DataFixtures\Currency;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\EntityInterface\Currency\CurrencyInterface;
use App\Interface\DataFixturesInterface\DataFixturesFactoryInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CurrencyFixtures extends DataFixtures
{

    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        // TODO: Implement load() method.
        parent::load($manager, $property, $n);
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->arrayNode('currencies')
            ->scalarPrototype()
            ->end()
            ->end();
    }

}


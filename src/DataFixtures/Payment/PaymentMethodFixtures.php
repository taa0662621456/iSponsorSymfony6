<?php

namespace App\DataFixtures\Payment;

use App\Entity\Currency\Currency;
use App\Entity\Payment\PaymentMethod;
use App\Entity\Shipment\ShipmentMethod;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PaymentMethodFixtures extends DataFixtures
{
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
                ->booleanNode('enabled')->end();
    }

    #[NoReturn]
    public function load(ObjectManager $manager, $property = [], $n = 1): void
    {
        $faker = Factory::create();

        $property = [];

        $i = 1;

        $property = [
            'firstTitle' => $faker->realText(),
            'lastTitle' => $faker->realText(7000),
        ];

        parent::load($manager, $property, $n);
    }

}

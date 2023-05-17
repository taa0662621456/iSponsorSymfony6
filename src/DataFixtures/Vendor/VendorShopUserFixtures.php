<?php


namespace App\DataFixtures\Vendor;


use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use JetBrains\PhpStorm\NoReturn;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class VendorShopUserFixtures extends DataFixtures
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('email')->cannotBeEmpty()->end()
                ->scalarNode('first_name')->cannotBeEmpty()->end()
                ->scalarNode('last_name')->cannotBeEmpty()->end()
                ->scalarNode('gender')->end()
                ->scalarNode('phone_number')->end()
                ->scalarNode('birthday')->end()
                ->booleanNode('enabled')->end()
                ->scalarNode('password')->cannotBeEmpty()->end()
                ->scalarNode('customer_group')->end()
        ;
    }
}

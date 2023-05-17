<?php

namespace App\DataFixtures\Product;


use App\DataFixtures\Project\ProjectTypeFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

use App\DataFixtures\DataFixtures;


use JetBrains\PhpStorm\NoReturn;

use App\Interface\DataFixturesInterface\DataFixturesFactoryInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;


final class ProductAttributeFixtures extends DataFixtures
{

    private readonly DataFixturesFactoryInterface $exampleFactory;

    public function __construct(ObjectManager $manager, array $property = [], ?int $n = self::DATA_FIXTURES)
    {
        parent::__construct($manager, $property, $n);
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('name')->cannotBeEmpty()->end()
            ->scalarNode('code')->cannotBeEmpty()->end()
            ->booleanNode('translatable')->defaultTrue()->end()
            ->enumNode('type')->values(['text', 'number', 'boolean'])->cannotBeEmpty()->end()
            ->variableNode('configuration')->end()
        ;
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

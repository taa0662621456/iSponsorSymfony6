<?php

namespace App\DataFixtures\Product;

use App\DataFixtures\AbstractDataFixture;
use App\Interface\FixtureFactoryInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class ProductAttributeFixture extends AbstractDataFixture
{
    private array $attributeTypes;

    public function __construct(ObjectManager $objectManager, FixtureFactoryInterface $exampleFactory, array $attributeTypes)
    {
        parent::__construct($objectManager, $exampleFactory);

        $this->attributeTypes = array_keys($attributeTypes);
    }

    public function getName(): string
    {
        return 'product_attribute';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->booleanNode('translatable')->defaultTrue()->end()
                ->enumNode('type')->values($this->attributeTypes)->cannotBeEmpty()->end()
                ->variableNode('configuration')->end()
        ;
    }
}

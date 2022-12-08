<?php


namespace App\CoreBundle\Fixture;

use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ProductAttributeFixture extends AbstractResourceFixture
{
    private array $attributeTypes;

    public function __construct(ObjectManager $objectManager, ExampleFactoryInterface $exampleFactory, array $attributeTypes)
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

<?php

namespace App\DataFixtures;

use App\Interface\Fixture\FixtureFactoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractDataFixture extends Fixture implements FixtureInterface
{
    private OptionsResolver $optionsResolver;


    public function __construct(protected readonly ObjectManager           $objectManager,
                                protected readonly FixtureFactoryInterface $exampleFactory)
    {

        $this->optionsResolver = (new OptionsResolver())
            ->setDefault('random', 0)
            ->setAllowedTypes('random', 'int')
            ->setDefault('prototype', [])
            ->setAllowedTypes('prototype', 'array')
            ->setDefault('custom', [])
            ->setAllowedTypes('custom', 'array')
            ->setNormalizer('custom', function (Options $options, array $custom) {
                if ($options['random'] <= 0) {
                    return $custom;
                }

                return array_merge($custom, array_fill(0, $options['random'], $options['prototype']));
            });
    }

    public function load(ObjectManager $manager): void
    {
        $options = $this->optionsResolver->resolve((array) $manager);

        $i = 0;
        foreach ($options['custom'] as $resourceOptions) {
            $resource = $this->exampleFactory->create($resourceOptions);

            $this->objectManager->persist($resource);

            ++$i;

            if (0 === ($i % 10)) {
                $this->objectManager->flush();
                $this->objectManager->clear();
            }
        }

        $this->objectManager->flush();
        $this->objectManager->clear();
    }

    final public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder($this->getName());

        /** @var ArrayNodeDefinition $optionsNode */
        $optionsNode = $treeBuilder->getRootNode();

        $optionsNode->children()
            ->integerNode('random')->min(0)->defaultValue(0)->end()
            ->variableNode('prototype')->end()
        ;

        $resourcesNode = $optionsNode->children()->arrayNode('custom');

        $resourceNode = $resourcesNode->requiresAtLeastOneElement()->arrayPrototype();
        $this->configureResourceNode($resourceNode);

        return $treeBuilder;
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        // empty
    }
}

<?php


namespace App\DataFixtures\Factory;



use Symfony\Component\OptionsResolver\OptionsResolver;

final class CatalogPromotionScopeExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private OptionsResolver $optionsResolver;

    public function __construct(private FactoryInterface $catalogPromotionScopeFactory)
    {
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): CatalogPromotionScopeInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var CatalogPromotionScopeInterface $catalogPromotionScope */
        $catalogPromotionScope = $this->catalogPromotionScopeFactory->createNew();
        $catalogPromotionScope->setType($options['type']);
        $catalogPromotionScope->setConfiguration($options['configuration']);

        return $catalogPromotionScope;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('type', InForVariantsScopeVariantChecker::TYPE)
            ->setAllowedTypes('type', 'string')
            ->setDefault('configuration', [])
            ->setAllowedTypes('configuration', 'array')
        ;
    }
}

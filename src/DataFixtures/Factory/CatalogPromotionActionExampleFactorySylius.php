<?php


namespace App\DataFixtures\Factory;



use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

classCatalogPromotionActionExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private OptionsResolver $optionsResolver;

    public function __construct(private FactoryInterface $catalogPromotionActionFactory)
    {
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): CatalogPromotionActionInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var CatalogPromotionActionInterface $catalogPromotionAction */
        $catalogPromotionAction = $this->catalogPromotionActionFactory->createNew();
        $catalogPromotionAction->setType($options['type']);
        $catalogPromotionAction->setConfiguration($options['configuration']);

        return $catalogPromotionAction;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('type', PercentageDiscountPriceCalculator::TYPE)
            ->setAllowedTypes('type', 'string')
            ->setDefault('configuration', [])
            ->setAllowedTypes('configuration', 'array')
            ->setNormalizer('configuration', function (Options $options, array $configuration): array {
                if ($options['type'] !== FixedDiscountPriceCalculator::TYPE) {
                    return $configuration;
                }

                foreach ($configuration as $channelCode => $channelConfiguration) {
                    if (isset($channelConfiguration['amount'])) {
                        $configuration[$channelCode]['amount'] = (int) ($configuration[$channelCode]['amount'] * 100);
                    }
                }

                return $configuration;
            })
        ;
    }
}

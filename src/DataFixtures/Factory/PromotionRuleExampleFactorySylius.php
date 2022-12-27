<?php


namespace App\DataFixtures\Factory;

use Faker\Factory;
use Faker\Generator;


use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionRuleExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(private PromotionRuleFactoryInterface $promotionRuleFactory)
    {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): PromotionRuleInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var PromotionRuleInterface $promotionRule */
        $promotionRule = $this->promotionRuleFactory->createNew();
        $promotionRule->setType($options['type']);
        $promotionRule->setConfiguration($options['configuration']);

        return $promotionRule;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('type', CartQuantityRuleChecker::TYPE)
            ->setAllowedTypes('type', 'string')
            ->setDefault('configuration', [
                'count' => $this->faker->randomNumber(1),
            ])
            ->setNormalizer('configuration', function (Options $options, array $configuration): array {
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

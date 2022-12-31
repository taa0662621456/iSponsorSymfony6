<?php


namespace App\DataFixtures\Factory;

use Faker\Factory;
use Faker\Generator;





use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxRateExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(
        private FactoryInterface $taxRateFactory,
        private RepositoryInterface $zoneRepository,
        private RepositoryInterface $taxCategoryRepository,
    ) {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): TaxRateInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var TaxRateInterface $taxRate */
        $taxRate = $this->taxRateFactory->createNew();

        $taxRate->setCode($options['code']);
        $taxRate->setName($options['name']);
        $taxRate->setAmount($options['amount']);
        $taxRate->setIncludedInPrice($options['included_in_price']);
        $taxRate->setCalculator($options['calculator']);
        $taxRate->setZone($options['zone']);
        $taxRate->setCategory($options['category']);

        return $taxRate;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('code', fn (Options $options): string => StringInflector::nameToCode($options['name']))
            ->setDefault('name', function (Options $options): string {
                /** @var string $words */
                $words = $this->faker->words(3, true);

                return $words;
            })
            ->setDefault('amount', fn (Options $options): float => $this->faker->randomFloat(2, 0, 0.4))
            ->setAllowedTypes('amount', 'float')
            ->setDefault('included_in_price', fn (Options $options): bool => $this->faker->boolean())
            ->setAllowedTypes('included_in_price', 'bool')
            ->setDefault('calculator', 'default')
            ->setDefault('zone', LazyOption::randomOne($this->zoneRepository))
            ->setAllowedTypes('zone', ['null', 'string', ZoneInterface::class])
            ->setNormalizer('zone', LazyOption::getOneBy($this->zoneRepository, 'code'))
            ->setDefault('category', LazyOption::randomOne($this->taxCategoryRepository))
            ->setAllowedTypes('category', ['null', 'string', TaxCategoryInterface::class])
            ->setNormalizer('category', LazyOption::getOneBy($this->taxCategoryRepository, 'code'))
        ;
    }
}

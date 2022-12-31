<?php


namespace App\DataFixtures\Factory;

use Faker\Factory;
use Faker\Generator;


use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShippingCategoryExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(private FactoryInterface $shippingCategoryFactory)
    {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): ShippingCategoryInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var ShippingCategoryInterface $shippingCategory */
        $shippingCategory = $this->shippingCategoryFactory->createNew();

        $shippingCategory->setCode($options['code']);
        $shippingCategory->setName($options['name']);
        $shippingCategory->setDescription($options['description']);

        return $shippingCategory;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('name', function (Options $options): string {
                /** @var string $words */
                $words = $this->faker->words(3, true);

                return $words;
            })
            ->setDefault('code', fn (Options $options): string => StringInflector::nameToCode($options['name']))
            ->setDefault('description', fn (Options $options): string => $this->faker->paragraph)
        ;
    }
}

<?php


namespace App\Factory\Factory;

use Faker\Factory;
use Faker\Generator;




use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ProductAttributeExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(
        private AttributeFactoryInterface $productAttributeFactory,
        private RepositoryInterface $localeRepository,
        private array $attributeTypes,
    ) {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): ProductAttributeInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var ProductAttributeInterface $productAttribute */
        $productAttribute = $this->productAttributeFactory->createTyped($options['type']);
        $productAttribute->setCode($options['code']);
        $productAttribute->setTranslatable($options['translatable']);

        foreach ($this->getLocales() as $localeCode) {
            $productAttribute->setCurrentLocale($localeCode);
            $productAttribute->setFallbackLocale($localeCode);

            $productAttribute->setName($options['name']);
        }

        $productAttribute->setConfiguration($options['configuration']);

        return $productAttribute;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('name', function (Options $options): string {
                /** @var string $words */
                $words = $this->faker->words(3, true);

                return $words;
            })
            ->setDefault('translatable', true)
            ->setDefault('code', fn (Options $options): string => StringInflector::nameToCode($options['name']))
            ->setDefault('type', fn (Options $options): string => $this->faker->randomElement(array_keys($this->attributeTypes)))
            ->setDefault('configuration', fn (Options $options): array => [])
            ->setAllowedValues('type', array_keys($this->attributeTypes))
        ;
    }

    private function getLocales(): iterable
    {
        /** @var LocaleInterface[] $locales */
        $locales = $this->localeRepository->findAll();
        foreach ($locales as $locale) {
            yield $locale->getCode();
        }
    }
}

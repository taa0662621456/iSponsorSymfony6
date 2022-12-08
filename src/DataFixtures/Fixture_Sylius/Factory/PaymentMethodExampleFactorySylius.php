<?php


namespace App\DataFixtures\Fixture_Sylius\Factory;

use Faker\Factory;
use Faker\Generator;





use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentMethodExampleFactorySylius extends SyliusAbstractExampleFactory implements ExampleFactoryInterface
{
    public const DEFAULT_LOCALE = 'en_US';

    private Generator $faker;

    private OptionsResolver $optionsResolver;

    public function __construct(
        private PaymentMethodFactoryInterface $paymentMethodFactory,
        private RepositoryInterface $localeRepository,
        private ChannelRepositoryInterface $channelRepository,
    ) {
        $this->faker = Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): PaymentMethodInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var PaymentMethodInterface $paymentMethod */
        $paymentMethod = $this->paymentMethodFactory->createWithGateway($options['gatewayFactory']);
        $paymentMethod->getGatewayConfig()->setGatewayName($options['gatewayName']);
        $paymentMethod->getGatewayConfig()->setConfig($options['gatewayConfig']);

        $paymentMethod->setCode($options['code']);
        $paymentMethod->setEnabled($options['enabled']);

        foreach ($this->getLocales() as $localeCode) {
            $paymentMethod->setCurrentLocale($localeCode);
            $paymentMethod->setFallbackLocale($localeCode);

            $paymentMethod->setName($options['name']);
            $paymentMethod->setDescription($options['description']);
            $paymentMethod->setInstructions($options['instructions']);
        }

        foreach ($options['channels'] as $channel) {
            $paymentMethod->addChannel($channel);
        }

        return $paymentMethod;
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
            ->setDefault('description', fn (Options $options): string => $this->faker->sentence())
            ->setDefault('instructions', null)
            ->setAllowedTypes('instructions', ['null', 'string'])
            ->setDefault('gatewayName', 'Offline')
            ->setDefault('gatewayFactory', 'offline')
            ->setDefault('gatewayConfig', [])
            ->setDefault('enabled', fn (Options $options): bool => $this->faker->boolean(90))
            ->setDefault('channels', LazyOption::all($this->channelRepository))
            ->setAllowedTypes('channels', 'array')
            ->setNormalizer('channels', LazyOption::findBy($this->channelRepository, 'code'))
            ->setAllowedTypes('enabled', 'bool')
        ;
    }

    private function getLocales(): iterable
    {
        /** @var LocaleInterface[] $locales */
        $locales = $this->localeRepository->findAll();
        if (empty($locales)) {
            yield self::DEFAULT_LOCALE;
        }

        foreach ($locales as $locale) {
            yield $locale->getCode();
        }
    }
}

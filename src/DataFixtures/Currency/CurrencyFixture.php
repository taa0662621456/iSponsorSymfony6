<?php

namespace App\DataFixtures\Currency;

use App\DataFixtures\AbstractDataFixture;
use App\Interface\Currency\CurrencyInterface;
use App\Interface\Fixture\FixtureFactoryInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CurrencyFixture extends AbstractDataFixture
{
    public function __construct(private readonly FixtureFactoryInterface $currencyFactory, private readonly ObjectManager $currencyManager)
    {
        parent::__construct();
    }

    public function load($options): void
    {
        foreach ($options['currencies'] as $currencyCode) {
            /** @var CurrencyInterface $currency */
            $currency = $this->currencyFactory->createNew();

            $currency->setCode($currencyCode);

            $this->currencyManager->persist($currency);
        }

        $this->currencyManager->flush();
    }

    public function getName(): string
    {
        return 'currency';
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->arrayNode('currencies')
            ->scalarPrototype()
            ->end()
            ->end();
    }
}


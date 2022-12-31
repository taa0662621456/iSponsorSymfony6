<?php


namespace App\DataFixtures\Fixture_Sylius;

use Doctrine\Persistence\ObjectManager;


use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class CurrencyFixture extends AbstractFixture
{
    public function __construct(private FactoryInterface $currencyFactory, private ObjectManager $currencyManager)
    {
    }

    public function load(array $options): void
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
        ;
    }
}

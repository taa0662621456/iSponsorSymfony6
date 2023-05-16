<?php

namespace App\DataFixtures\Paymant;

use App\Entity\Currency\Currency;
use App\Entity\Payment\PaymentMethod;
use App\Entity\Shipment\ShipmentMethod;
use App\DataFixtures\AbstractDataFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class PaymentMethodFixture extends AbstractDataFixture
{

    public function getName(): string
    {
        return 'payment_method';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('code')->cannotBeEmpty()->end()
                ->scalarNode('name')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('instructions')->end()
                ->scalarNode('gatewayName')->cannotBeEmpty()->end()
                ->scalarNode('gatewayFactory')->cannotBeEmpty()->end()
                ->arrayNode('gatewayConfig')->variablePrototype()->end()->end()
                ->variableNode('channels')
                    ->beforeNormalization()
                        ->ifNull()->thenUnset()
                    ->end()
                ->end()
                ->booleanNode('enabled')->end();
    }

    // php data import
    public function load($options): void
    {
        $fixtureConfig = require 'src/DataFixtures/fixtures.php';

        // Извлекаем данные для создания фикстур
        $currencies = $fixtureConfig['currency']['options']['currencies'];
        $channels = $fixtureConfig['channel']['options']['custom'];
        $shipmentMethod = $fixtureConfig['shipment_method']['options']['custom'];
        $paymentMethods = $fixtureConfig['payment_method']['options']['custom'];

        // Создаем фикстуры для валют
        foreach ($currencies as $currencyCode) {
            $currency = new Currency();
            $currency->setCode($currencyCode);

            // Добавляем $currency в EntityManager
            $this->entityManager->persist($currency);
        }

        // Создаем фикстуры для каналов
        foreach ($channels as $channelData) {
            $channel = new Channel();
            $channel->setName($channelData['name']);
            $channel->setCode($channelData['code']);
            $channel->setLocales($channelData['locales']);
            $channel->setCurrencies($channelData['currencies']);
            $channel->setEnabled($channelData['enabled']);
            $channel->setHostname($channelData['hostname']);

            // Добавляем $channel в EntityManager
            $this->entityManager->persist($channel);
        }

        // Создаем фикстуры для методов доставки
        foreach ($shipmentMethod as $shippingMethodData) {
            $shippingMethod = new ShipmentMethod();
            $shippingMethod->setCode($shippingMethodData['code']);
            $shippingMethod->setName($shippingMethodData['name']);
            $shippingMethod->setEnabled($shippingMethodData['enabled']);

            // Добавляем $shippingMethod в EntityManager
            $this->entityManager->persist($shippingMethod);
        }

        // Создаем фикстуры для методов оплаты
        foreach ($paymentMethods as $paymentMethodData) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->setCode($paymentMethodData['code']);
            $paymentMethod->setName($paymentMethodData['name']);

            // Добавляем $paymentMethod в EntityManager
            $this->entityManager->persist($paymentMethod);
        }

        // Сохраняем все изменения в базе данных
        $this->entityManager->flush();
        $this->entityManager->clear();
    }


    /* yaml data import
    public function load($options): void
    {
        $fixtureConfig = Yaml::parseFile('/path/to/fixture.yaml');

        // Извлекаем данные для создания фикстур
        $currencies = $fixtureConfig['fixtures']['suites']['default']['fixtures']['currency']['options']['currencies'];
        $vendors = $fixtureConfig['fixtures']['suites']['default']['fixtures']['channel']['options']['custom'];
        $shipmentMethod = $fixtureConfig['fixtures']['suites']['default']['fixtures']['shipment_method']['options']['custom'];
        $paymentMethods = $fixtureConfig['fixtures']['suites']['default']['fixtures']['payment_method']['options']['custom'];

        // Создаем и сохраняем фикстуры с полученными данными
        // ...

        // Пример создания фикстуры Currency
        foreach ($currencies as $currencyCode) {
            $currency = new Currency();
            $currency->setCode($currencyCode);
            // ...
            $this->entityManager->persist($currency);
        }

        // Пример создания фикстур Channel
        foreach ($vendors as $vendorCode => $vendorData) {
            $vendor = new Vendor();
            $vendor->setCode($vendorData['code']);
            $vendor->setName($vendorData['name']);
            // ...
            $this->entityManager->persist($vendor);
        }

        // Пример создания фикстур ShippingMethod
        foreach ($shipmentMethod as $shippingMethodCode => $shippingMethodData) {
            $shippingMethod = new ShipmentMethod();
            $shippingMethod->setCode($shippingMethodData['code']);
            $shippingMethod->setName($shippingMethodData['name']);
            // ...
            $this->entityManager->persist($shippingMethod);
        }

        // Пример создания фикстур PaymentMethod
        foreach ($paymentMethods as $paymentMethodCode => $paymentMethodData) {
            $paymentMethod = new PaymentMethod();
            $paymentMethod->setCode($paymentMethodData['code']);
            $paymentMethod->setName($paymentMethodData['name']);
            // ...
            $this->entityManager->persist($paymentMethod);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();
    }
    */
}

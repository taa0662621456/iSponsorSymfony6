<?php

namespace App\DataFixturesFactory\Payment;

use App\DataFixturesFactoryInterface\Payment\PaymentMethodDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\DataFixtures\DataFixturesFactory;

final class PaymentMethodDataFixturesFactory extends DataFixturesFactory implements PaymentMethodDataFixturesFactoryInterface
{
    private ObjectFactoryInterface $objectFactory;

    public function __construct(ObjectFactoryInterface $objectFactory)
    {
        parent::__construct();
        $this->objectFactory = $objectFactory;
    }

    /**
     * @throws \Exception
     */
    public function __invoke(array $options = []): object
    {
        return $this->objectFactory->create(__CLASS__, $options);
    }

    public function getGatewayConfig()
    {
        // TODO: Implement getGatewayConfig() method.
    }

    public function setCode(mixed $code)
    {
        // TODO: Implement setCode() method.
    }

    public function setEnabled(mixed $enabled)
    {
        // TODO: Implement setEnabled() method.
    }

    public function setCurrentLocale(mixed $localeCode)
    {
        // TODO: Implement setCurrentLocale() method.
    }

    public function setFallbackLocale(mixed $localeCode)
    {
        // TODO: Implement setFallbackLocale() method.
    }

    public function setName(mixed $name)
    {
        // TODO: Implement setName() method.
    }

    public function setDescription(mixed $description)
    {
        // TODO: Implement setDescription() method.
    }

    public function setInstructions(mixed $instructions)
    {
        // TODO: Implement setInstructions() method.
    }

    public function addChannel(mixed $channel)
    {
        // TODO: Implement addChannel() method.
    }
}

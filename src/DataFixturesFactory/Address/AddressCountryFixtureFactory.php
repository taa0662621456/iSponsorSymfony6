<?php

namespace App\DataFixturesFactory\Address;

use App\DataFixturesFactoryInterface\Address\AddressCountryDataFixturesFactoryInterface;
use App\Service\Object\ObjectFactory;
use App\Interface\Object\ObjectFactoryInterface;

class AddressCountryFixtureFactory extends ObjectFactory implements AddressCountryDataFixturesFactoryInterface
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

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function getProvinces()
    {
        // TODO: Implement getProvinces() method.
    }
}

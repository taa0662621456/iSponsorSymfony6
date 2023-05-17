<?php

namespace App\DataFixturesFactory\Vendor;


use App\DataFixturesFactoryInterface\Vendor\VendorEnUsDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;

class VendorEnUsFixtureFactory extends ObjectFactory implements VendorEnUsDataFixturesFactoryInterface
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

}

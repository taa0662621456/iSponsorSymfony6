<?php

namespace App\DataFixturesFactory\Product;

use App\DataFixturesFactoryInterface\Product\ProductAttributeDataFixturesFactoryInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;

class ProductAttributeFixtureFactory extends ObjectFactory implements ProductAttributeDataFixturesFactoryInterface
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

    public function getType()
    {
        // TODO: Implement getType() method.
    }
}

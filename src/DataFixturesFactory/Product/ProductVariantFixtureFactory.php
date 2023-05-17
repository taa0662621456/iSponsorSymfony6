<?php

namespace App\DataFixturesFactory\Product;

use App\DataFixturesFactoryInterface\Product\ProductVariantDataFixturesFactoryInterface;
use App\EntityInterface\Product\ProductInterface;
use App\Interface\Object\ObjectFactoryInterface;
use App\Service\Object\ObjectFactory;

class ProductVariantFixtureFactory extends ObjectFactory implements ProductVariantDataFixturesFactoryInterface
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

    public function generate(ProductInterface $product)
    {
        // TODO: Implement generate() method.
    }
}

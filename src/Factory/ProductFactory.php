<?php

namespace App\Factory;

use App\EventSubscriber\Product\ProductInterface;

class ProductFactory
{
    public function __construct(private $factory, private $variantFactory)
    {
    }

    public function createNew(): ProductInterface
    {
        return $this->factory->createNew();
    }

    public function createWithVariant(): ProductInterface
    {
        $variant = $this->variantFactory->createNew();

        /** @var ProductInterface $product */
        $product = $this->factory->createNew();
        $product->addVariant($variant);

        return $product;
    }
}

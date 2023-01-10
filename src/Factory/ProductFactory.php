<?php

namespace App\Factory;

use App\Interface\Product\ProductPropertyInterface;

class ProductFactory
{
    public function __construct(private $factory, private $variantFactory)
    {
    }

    public function createNew(): ProductPropertyInterface
    {
        return $this->factory->createNew();
    }

    public function createWithVariant(): ProductPropertyInterface
    {
        $variant = $this->variantFactory->createNew();

        /** @var ProductPropertyInterface $product */
        $product = $this->factory->createNew();
        $product->addVariant($variant);

        return $product;
    }
}

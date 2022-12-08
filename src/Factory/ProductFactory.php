<?php

namespace App\Factory;

class ProductFactory
{
    public function __construct(private FactoryInterface $factory, private FactoryInterface $variantFactory)
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

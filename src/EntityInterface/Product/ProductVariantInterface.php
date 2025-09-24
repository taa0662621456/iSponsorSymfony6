<?php

namespace App\EntityInterface\Product;

interface ProductVariantInterface
{
    public function generate(ProductInterface $product);
}
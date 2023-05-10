<?php

namespace App\Interface\Product;

interface ProductVariantInterface
{

    public function generate(ProductInterface $product);
}

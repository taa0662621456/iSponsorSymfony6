<?php

namespace App\Service;

use App\Entity\Product\Product;

interface ProductTaxServiceInterface
{
    /** @param int[] $taxIds */
    public function assignTaxes(Product $product, array $taxIds, object $by): array;
}
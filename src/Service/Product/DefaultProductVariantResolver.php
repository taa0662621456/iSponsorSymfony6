<?php

namespace App\Service\Product;

use App\EntityInterface\Product\ProductInterface;
use App\EntityInterface\Product\ProductVariantInterface;
use App\EntityInterface\Product\ProductVariantResolverInterface;

final class DefaultProductVariantResolver implements ProductVariantResolverInterface
{
    public function getVariant(ProductInterface $subject): ?ProductVariantInterface
    {
        if ($subject->getEnabledVariants()->isEmpty()) {
            return null;
        }

        return $subject->getEnabledVariants()->first();
    }
}

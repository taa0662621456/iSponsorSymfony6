<?php

namespace App\Service\Product;

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

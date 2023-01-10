<?php

namespace App\Service\Product;

use App\Interface\Product\ProductAvailableOptionValuesResolverInterface;
use App\Interface\Product\ProductInterface;
use App\Interface\Product\ProductOptionInterface;
use Doctrine\Common\Collections\Collection;

final class ProductAvailableOptionValuesResolver implements ProductAvailableOptionValuesResolverInterface
{
    public function resolve(ProductInterface $product, ProductOptionInterface $productOption): Collection
    {
        if (!$product->hasOption($productOption)) {
            throw new \InvalidArgumentException(sprintf('Cannot resolve available product option values. Option "%s" does not belong to product "%s".', $product->getCode(), $productOption->getCode()));
        }

        return $productOption->getValues()->filter(
            static function (ProductOptionInterface $productOptionValue) use ($product) {
                foreach ($product->getEnabledVariants() as $productVariant) {
                    if ($productVariant->hasOptionValue($productOptionValue)) {
                        return true;
                    }
                }

                return false;
            },
        );
    }
}

<?php

namespace App\Dto\Product;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProductFavouriteDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private ProductDTO $productFavouriteDTO;

    public function getProductFavourite(): ProductDTO
    {
        return $this->productFavourite;
    }

    public function setProductFavourite(ProductDTO $productFavourite): void
    {
        $this->productFavourite = $productFavourite;
    }
}

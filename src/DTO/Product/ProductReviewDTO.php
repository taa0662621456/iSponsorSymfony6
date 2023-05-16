<?php

namespace App\DTO\Product;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProductReviewDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    public const NUM_ROWS = 10;

    private ?string $productId = null;

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): void
    {
        $this->productId = $productId;
    }

    private Product $productReviewProductDTO;

    // ManyToOne
    public function getProductReviewProduct(): Product
    {
        return $this->productReviewProduct;
    }

    public function setProductReviewProduct(Product $product): void
    {
        $this->productReviewProduct = $product;
    }
}

<?php

namespace App\Interface;

interface ProductReviewInterface
{
    public function getProductId(): ?string;
    public function setProductId(?string $productId): void;
    #
    public function getProductUuid(): ?string;
    public function setProductUuid(?string $productUuid): void;
    #
    public function getProductSlug(): ?string;
    public function setProductSlug(?string $productSlug): void;

}

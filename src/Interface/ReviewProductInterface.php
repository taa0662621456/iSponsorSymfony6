<?php

namespace App\Interface;

interface ReviewProductInterface
{
    /**
     * @return string|null
     */
    public function getProductId(): ?string;

    /**
     * @param string|null $productId
     */
    public function setProductId(?string $productId): void;

    /**
     * @return string|null
     */
    public function getProductUuid(): ?string;

    /**
     * @param string|null $productUuid
     */
    public function setProductUuid(?string $productUuid): void;

    /**
     * @return string|null
     */
    public function getProductSlug(): ?string;

    /**
     * @param string|null $productSlug
     */
    public function setProductSlug(?string $productSlug): void;

}

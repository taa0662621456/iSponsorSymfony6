<?php

namespace App\EntityInterface\Product;
use Doctrine\ORM\Mapping as ORM;

interface ProductStorageInterface
{
    public function getProductSku(): int;

    public function setProductSku(int $productSku): void;

    public function getProductGtin(): ?int;

    public function setProductGtin(int $productGtin): void;

    public function getProductMpn(): ?int;

    public function setProductMpn(int $productMpn): void;

    public function getProductInStock(): int;

    public function setProductInStock(int $productInStock): void;

    public function getProductStockHandle(): string;

    public function setProductStockHandle(string $productStockHandle): void;

    public function getLowStockNotification(): int;

    public function setLowStockNotification(int $lowStockNotification): void;

    public function isProductAvailability(): bool;

    public function setProductAvailability(bool $productAvailability): void;

    public function isProductSpecial(): bool;

    public function setProductSpecial(bool $productSpecial): void;

    public function isProductDiscontinued(): bool;

    public function setProductDiscontinued(bool $productDiscontinued): void;

    public function getProductSales(): ?int;

    public function setProductSales(int $productSales): void;

    public function getProductUnit(): ?int;

    public function setProductUnit(int $productUnit): void;

    public function getProductPackaging(): ?int;

    public function setProductPackaging(int $productPackaging): void;

    public function getProductParam(): string;

    public function setProductParam(string $productParam): void;
}

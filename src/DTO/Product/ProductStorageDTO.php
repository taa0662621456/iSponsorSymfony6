<?php

namespace App\DTO\Product;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class ProductStorageDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $productSku = 0;

    private int $productGtin = 0;

    private int $productMpn = 0;

    private int $productInStock = 0;

    private string $productStockHandle = 'product_stock_handle';

    private int $lowStockNotification = 0;

    private string $productAvailableDateDTO;

    private bool $productAvailability = false;

    private bool $productSpecial = false;

    private bool $productDiscontinued = false;

    private int $productSales = 0;

    private int $productUnit = 0;

    private ?int $productPackaging = null;

    private ?string $productParam = null;

    public function getProductSku(): int
    {
        return $this->productSku;
    }

    public function setProductSku(int $productSku): void
    {
        $this->productSku = $productSku;
    }

    public function getProductGtin(): int
    {
        return $this->productGtin;
    }

    public function setProductGtin(int $productGtin): void
    {
        $this->productGtin = $productGtin;
    }

    public function getProductMpn(): int
    {
        return $this->productMpn;
    }

    public function setProductMpn(int $productMpn): void
    {
        $this->productMpn = $productMpn;
    }

    public function getProductInStock(): int
    {
        return $this->productInStock;
    }

    public function setProductInStock(int $productInStock): void
    {
        $this->productInStock = $productInStock;
    }

    public function getProductStockHandle(): string
    {
        return $this->productStockHandle;
    }

    public function setProductStockHandle(string $productStockHandle): void
    {
        $this->productStockHandle = $productStockHandle;
    }

    public function getLowStockNotification(): int
    {
        return $this->lowStockNotification;
    }

    public function setLowStockNotification(int $lowStockNotification): void
    {
        $this->lowStockNotification = $lowStockNotification;
    }

    public function getProductAvailableDate(): string
    {
        return $this->productAvailableDate;
    }

    public function setProductAvailableDate(string $productAvailableDate): void
    {
        $t = new \DateTime();
    }

    public function isProductAvailability(): bool
    {
        return $this->productAvailability;
    }

    public function setProductAvailability(bool $productAvailability): void
    {
        $this->productAvailability = $productAvailability;
    }

    public function isProductSpecial(): bool
    {
        return $this->productSpecial;
    }

    public function setProductSpecial(bool $productSpecial): void
    {
        $this->productSpecial = $productSpecial;
    }

    public function isProductDiscontinued(): bool
    {
        return $this->productDiscontinued;
    }

    public function setProductDiscontinued(bool $productDiscontinued): void
    {
        $this->productDiscontinued = $productDiscontinued;
    }

    public function getProductSales(): int
    {
        return $this->productSales;
    }

    public function setProductSales(int $productSales): void
    {
        $this->productSales = $productSales;
    }

    public function getProductUnit(): int
    {
        return $this->productUnit;
    }

    public function setProductUnit(int $productUnit): void
    {
        $this->productUnit = $productUnit;
    }

    public function getProductPackaging(): ?int
    {
        return $this->productPackaging;
    }

    public function setProductPackaging(?int $productPackaging): void
    {
        $this->productPackaging = $productPackaging;
    }

    public function getProductParam(): string
    {
        return $this->productParam;
    }

    public function setProductParam(?string $productParam): void
    {
        $this->productParam = $productParam;
    }
}

<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductStorageInterface;

#[ORM\Entity]
final class ProductStorage extends ObjectSuperEntity implements ObjectInterface, ProductStorageInterface
{
    #[ORM\Column(name: 'product_sku', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productSku = 0;

    #[ORM\Column(name: 'product_gtin', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productGtin = 0;

    #[ORM\Column(name: 'product_mpn', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productMpn = 0;

    #[ORM\Column(name: 'product_in_stock', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productInStock = 0;

    #[ORM\Column(name: 'product_stock_handle', type: 'string', nullable: false, options: ['default' => 'product_stock_handle'])]
    private string $productStockHandle = 'product_stock_handle';

    #[ORM\Column(name: 'low_stock_notification', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $lowStockNotification = 0;

    #[ORM\Column(name: 'product_available_date', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $productAvailableDate;

    #[ORM\Column(name: 'product_availability', type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $productAvailability = false;

    #[ORM\Column(name: 'product_special', type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $productSpecial = false;

    #[ORM\Column(name: 'product_discontinued', type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $productDiscontinued = false;

    #[ORM\Column(name: 'product_sales', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productSales = 0;

    #[ORM\Column(name: 'product_unit', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productUnit = 0;

    #[ORM\Column(name: 'product_packaging', nullable: true)]
    private ?int $productPackaging = null;

    #[ORM\Column(name: 'product_param', nullable: true)]
    private ?string $productParam = null;

    public function __construct()
    {
        parent::__construct();
        $t = new \DateTime();
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');
    }

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
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');
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

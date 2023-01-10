<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Odm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Interface\Product\ProductStorageInterface;
use App\Repository\Product\ProductStorageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'product_storage')]
#[ORM\Index(columns: ['slug'], name: 'product_storage_idx')]
#[ORM\Entity(repositoryClass: ProductStorageRepository::class)]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
class ProductStorage implements ProductStorageInterface
{
    use ObjectBaseTrait;

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
        $t = new \DateTime();
        $this->slug = (string) Uuid::v4();
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }

    /**
     * @return int
     */
    public function getProductSku(): int
    {
        return $this->productSku;
    }

    /**
     * @param int $productSku
     */
    public function setProductSku(int $productSku): void
    {
        $this->productSku = $productSku;
    }

    /**
     * @return int
     */
    public function getProductGtin(): int
    {
        return $this->productGtin;
    }

    /**
     * @param int $productGtin
     */
    public function setProductGtin(int $productGtin): void
    {
        $this->productGtin = $productGtin;
    }

    /**
     * @return int
     */
    public function getProductMpn(): int
    {
        return $this->productMpn;
    }

    /**
     * @param int $productMpn
     */
    public function setProductMpn(int $productMpn): void
    {
        $this->productMpn = $productMpn;
    }

    /**
     * @return int
     */
    public function getProductInStock(): int
    {
        return $this->productInStock;
    }

    /**
     * @param int $productInStock
     */
    public function setProductInStock(int $productInStock): void
    {
        $this->productInStock = $productInStock;
    }

    /**
     * @return string
     */
    public function getProductStockHandle(): string
    {
        return $this->productStockHandle;
    }

    /**
     * @param string $productStockHandle
     */
    public function setProductStockHandle(string $productStockHandle): void
    {
        $this->productStockHandle = $productStockHandle;
    }

    /**
     * @return int
     */
    public function getLowStockNotification(): int
    {
        return $this->lowStockNotification;
    }

    /**
     * @param int $lowStockNotification
     */
    public function setLowStockNotification(int $lowStockNotification): void
    {
        $this->lowStockNotification = $lowStockNotification;
    }

    /**
     * @return string
     */
    public function getProductAvailableDate(): string
    {
        return $this->productAvailableDate;
    }

    /**
     * @param string $productAvailableDate
     */
    public function setProductAvailableDate(string $productAvailableDate): void
    {
        $t = new \DateTime();
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');
    }

    /**
     * @return bool
     */
    public function isProductAvailability(): bool
    {
        return $this->productAvailability;
    }

    /**
     * @param bool $productAvailability
     */
    public function setProductAvailability(bool $productAvailability): void
    {
        $this->productAvailability = $productAvailability;
    }

    /**
     * @return bool
     */
    public function isProductSpecial(): bool
    {
        return $this->productSpecial;
    }

    /**
     * @param bool $productSpecial
     */
    public function setProductSpecial(bool $productSpecial): void
    {
        $this->productSpecial = $productSpecial;
    }

    /**
     * @return bool
     */
    public function isProductDiscontinued(): bool
    {
        return $this->productDiscontinued;
    }

    /**
     * @param bool $productDiscontinued
     */
    public function setProductDiscontinued(bool $productDiscontinued): void
    {
        $this->productDiscontinued = $productDiscontinued;
    }

    /**
     * @return int
     */
    public function getProductSales(): int
    {
        return $this->productSales;
    }

    /**
     * @param int $productSales
     */
    public function setProductSales(int $productSales): void
    {
        $this->productSales = $productSales;
    }

    /**
     * @return int
     */
    public function getProductUnit(): int
    {
        return $this->productUnit;
    }

    /**
     * @param int $productUnit
     */
    public function setProductUnit(int $productUnit): void
    {
        $this->productUnit = $productUnit;
    }

    /**
     * @return int|null
     */
    public function getProductPackaging(): ?int
    {
        return $this->productPackaging;
    }

    /**
     * @param int|null $productPackaging
     */
    public function setProductPackaging(?int $productPackaging): void
    {
        $this->productPackaging = $productPackaging;
    }

    /**
     * @return string
     */
    public function getProductParam(): string
    {
        return $this->productParam;
    }

    /**
     * @param string|null $productParam
     */
    public function setProductParam(?string $productParam): void
    {
        $this->productParam = $productParam;
    }



}

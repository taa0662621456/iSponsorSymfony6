<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductStorageInterface;

#[ORM\Entity]
class ProductStorage extends RootEntity implements ObjectInterface, ProductStorageInterface
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

    #[ORM\OneToOne(inversedBy: 'productStorage', targetEntity: Product::class)]
    private Product $product;

    public function __construct()
    {
        parent::__construct();
        $t = new \DateTime();
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');
    }
}

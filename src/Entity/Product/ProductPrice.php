<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductPriceInterface;

#[ORM\Entity]
class ProductPrice extends ObjectSuperEntity implements ObjectInterface, ProductPriceInterface
{
    #[ORM\Column(name: 'product_id', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productId = 0;

    #[ORM\Column(name: 'shopper_group_id', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $shopperGroupId = 0;

    #[ORM\OneToOne(inversedBy: 'productPrice', targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Product|float $productPrice = -1.0;

    #[ORM\Column(name: 'override')]
    private ?bool $override = null;

    #[ORM\Column(name: 'product_override_price', type: 'decimal', precision: 7, scale: 2)]
    private ?int $productOverridePrice = null;

    #[ORM\Column(name: 'product_tax_id')]
    private ?int $productTaxId = null;

    #[ORM\Column(name: 'product_discount_id')]
    private ?int $productDiscountId = null;

    #[ORM\Column(name: 'product_currency')]
    private ?int $productCurrency = null;

    #[ORM\Column(name: 'product_price_publish_up', type: 'string', nullable: false)]
    private string $productPricePublishUp;

    #[ORM\Column(name: 'product_price_publish_down', type: 'string', nullable: false)]
    private string $productPricePublishDown;

    #[ORM\Column(name: 'price_quantity_start', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $priceQuantityStart = 0;

    #[ORM\Column(name: 'price_quantity_end', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $priceQuantityEnd = 0;
}

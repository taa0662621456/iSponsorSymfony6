<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductPriceInterface;

#[ORM\Entity]
class ProductPrice extends RootEntity implements ObjectInterface, ProductPriceInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'product_id', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productId = 0;

    #[ORM\Column(name: 'shopper_group_id', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $shopperGroupId = 0;

    #[ORM\OneToOne(inversedBy: 'productPrice', targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Product $productPrice;

    #[ORM\Column(name: 'override')]
    private ?bool $override = null;

    #[ORM\Column(name: 'product_override_price', type: 'decimal', precision: 7, scale: 2)]
    private ?string $productOverridePrice = null;

    #[ORM\Column(name: 'product_tax_id')]
    private ?int $productTaxId = null;

    #[ORM\Column(name: 'product_discount_id')]
    private ?int $productDiscountId = null;

    #[ORM\Column(name: 'product_currency')]
    private ?int $productCurrency = null;

    #[ORM\Column(name: 'product_price_publish_up', type: 'datetime', nullable: false)]
    private ?DateTimeInterface $productPricePublishUp = null;

    #[ORM\Column(name: 'product_price_publish_down', type: 'datetime', nullable: false)]
    private ?DateTimeInterface $productPricePublishDown;

    #[ORM\Column(name: 'price_quantity_start', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $priceQuantityStart = 0;

    #[ORM\Column(name: 'price_quantity_end', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $priceQuantityEnd = 0;
}

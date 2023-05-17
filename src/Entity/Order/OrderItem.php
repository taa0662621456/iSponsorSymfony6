<?php

namespace App\Entity\Order;

use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderItemInterface;

#[ORM\Entity]
class OrderItem extends ObjectSuperEntity implements ObjectInterface, OrderItemInterface
{
    #[ORM\Column(name: 'item_id', nullable: true)]
    private ?int $itemId = null;

    #[ORM\Column(name: 'item_sku', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $itemSku = 1;

    #[ORM\Column(name: 'item_name', type: 'string', nullable: false, options: ['default' => ''])]
    private string $itemName = 'item_name';

    #[ORM\Column(name: 'item_quantity', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $itemQuantity = 1;

    #[ORM\Column(name: 'item_price', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemPrice = null;

    #[ORM\Column(name: 'item_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemPriceWithoutTax = null;

    #[ORM\Column(name: 'item_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemTax = null;

    #[ORM\Column(name: 'item_base_price_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemBasePriceWithTax = null;

    #[ORM\Column(name: 'item_discounted_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemDiscountedPriceWithoutTax = null;

    #[ORM\Column(name: 'item_final_price', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private string $itemFinalPrice = '0.00000';

    #[ORM\Column(name: 'item_subtotal_discount', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private string $itemSubtotalDiscount = '0.00000';

    #[ORM\Column(name: 'item_subtotal_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private string $itemSubtotalWithTax = '0.00000';

    #[ORM\Column(name: 'item_order_currency', nullable: true)]
    private ?int $itemOrderCurrency = null;

    #[ORM\Column(name: 'item_attribute', nullable: true)]
    private ?string $itemAttribute = null;

    #[ORM\Column(name: 'item_hash', nullable: true)]
    private ?string $itemHash = null;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorItem')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Vendor $orderItemsVendor;

    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'orderItem')]
    private OrderStorage $orderItem;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productOrdered')]
    private Product $productOrdered;
}

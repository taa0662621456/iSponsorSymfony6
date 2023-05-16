<?php

namespace App\Entity\Order;

use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use Doctrine\DBAL\Types\TextType;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderItemInterface;

#[ORM\Entity]
final class OrderItem extends ObjectSuperEntity implements ObjectInterface, OrderItemInterface
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

    public function __construct()
    {
        $t = new \DateTime();
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(?int $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getItemSku(): int
    {
        return $this->itemSku;
    }

    public function setItemSku(?int $itemSku): void
    {
        $this->itemSku = $itemSku;
    }

    public function getItemName(): string
    {
        return $this->itemName;
    }

    public function setItemName(?string $itemName): void
    {
        $this->itemName = $itemName;
    }

    public function getItemQuantity(): ?int
    {
        return $this->itemQuantity;
    }

    public function setItemQuantity(?int $itemQuantity): void
    {
        $this->itemQuantity = $itemQuantity;
    }

    public function getItemPrice(): ?int
    {
        return $this->itemPrice;
    }

    public function setItemPrice($itemPrice): void
    {
        $this->itemPrice = $itemPrice;
    }

    public function getItemPriceWithoutTax(): ?int
    {
        return $this->itemPriceWithoutTax;
    }

    public function setItemPriceWithoutTax($itemPriceWithoutTax): void
    {
        $this->itemPriceWithoutTax = $itemPriceWithoutTax;
    }

    public function getItemTax(): ?int
    {
        return $this->itemTax;
    }

    public function setItemTax($itemTax): void
    {
        $this->itemTax = $itemTax;
    }

    public function getItemBasePriceWithTax(): ?int
    {
        return $this->itemBasePriceWithTax;
    }

    public function setItemBasePriceWithTax($itemBasePriceWithTax): void
    {
        $this->itemBasePriceWithTax = $itemBasePriceWithTax;
    }

    public function getItemDiscountedPriceWithoutTax(): ?int
    {
        return $this->itemDiscountedPriceWithoutTax;
    }

    public function setItemDiscountedPriceWithoutTax($itemDiscountedPriceWithoutTax): void
    {
        $this->itemDiscountedPriceWithoutTax = $itemDiscountedPriceWithoutTax;
    }

    public function getItemFinalPrice(): string
    {
        return $this->itemFinalPrice;
    }

    public function setItemFinalPrice($itemFinalPrice): void
    {
        $this->itemFinalPrice = $itemFinalPrice;
    }

    public function getItemSubtotalDiscount(): string
    {
        return $this->itemSubtotalDiscount;
    }

    public function setItemSubtotalDiscount($itemSubtotalDiscount): void
    {
        $this->itemSubtotalDiscount = $itemSubtotalDiscount;
    }

    public function getItemSubtotalWithTax(): string
    {
        return $this->itemSubtotalWithTax;
    }

    public function setItemSubtotalWithTax($itemSubtotalWithTax): void
    {
        $this->itemSubtotalWithTax = $itemSubtotalWithTax;
    }

    public function getItemOrderCurrency(): ?int
    {
        return $this->itemOrderCurrency;
    }

    public function setItemOrderCurrency(?int $itemOrderCurrency): void
    {
        $this->itemOrderCurrency = $itemOrderCurrency;
    }

    public function getItemAttribute(): string
    {
        return $this->itemAttribute;
    }

    public function setItemAttribute(?TextType $itemAttribute): void
    {
        $this->itemAttribute = $itemAttribute;
    }

    public function getItemHash(): ?string
    {
        return $this->itemHash;
    }

    public function setItemHash(?string $itemHash): void
    {
        $this->itemHash = $itemHash;
    }

    // ManyToOne
    public function getOrderItemsVendor(): Vendor
    {
        return $this->orderItemsVendor;
    }

    public function setOrderItemsVendor(Vendor $orderItemsVendor): void
    {
        $this->orderItemsVendor = $orderItemsVendor;
    }

    // ManyToOne
    public function getOrderItem(): OrderStorage
    {
        return $this->orderItem;
    }

    public function setOrderItem(OrderStorage $orderItem): void
    {
        $this->orderItem = $orderItem;
    }

    // ManyToOne
    public function getProductOrdered(): Product
    {
        return $this->productOrdered;
    }

    public function setProductOrdered(Product $productOrdered): void
    {
        $this->productOrdered = $productOrdered;
    }
}

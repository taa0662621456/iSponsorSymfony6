<?php

namespace App\Entity\Order;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderItemInterface;

#[ORM\Entity]
class OrderItem extends RootEntity implements ObjectInterface, OrderItemInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'order')]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'item_id', nullable: true)]
    private ?int $orderItemId = null;

    #[ORM\Column(name: 'item_sku', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $orderItemSku = 1;

    #[ORM\Column(name: 'item_name', type: 'string', nullable: false, options: ['default' => ''])]
    private string $orderItemName = 'item_name';

    #[ORM\Column(name: 'item_quantity', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $orderItemQuantity = 1;

    #[ORM\Column(name: 'item_price', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?string $orderItemPrice = null;

    #[ORM\Column(name: 'item_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?string $orderItemPriceWithoutTax = null;

    #[ORM\Column(name: 'item_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?string $orderItemTax = null;

    #[ORM\Column(name: 'item_base_price_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?string $orderItemBasePriceWithTax = null;

    #[ORM\Column(name: 'item_discounted_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?string $orderItemDiscountedPriceWithoutTax = null;

    #[ORM\Column(name: 'item_final_price', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private ?string $orderItemFinalPrice = '0.00000';

    #[ORM\Column(name: 'item_subtotal_discount', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private ?string $orderItemSubtotalDiscount = '0.00000';

    #[ORM\Column(name: 'item_subtotal_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private ?string $orderItemSubtotalWithTax = '0.00000';

    #[ORM\Column(name: 'item_order_currency', nullable: true)]
    private ?int $orderItemOrderCurrency = null;

    #[ORM\Column(name: 'item_attribute', nullable: true)]
    private ?string $orderItemAttribute = null;

    #[ORM\Column(name: 'item_hash', nullable: true)]
    private ?string $orderItemHash;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorOrderItem')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Vendor $orderItem;

    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'orderStorageItem')]
    private OrderStorage $orderItemStorage;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productOrdered')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Product $orderItemOrdered;

    /**
     * @return int|null
     */
    public function getOrderItemId(): ?int
    {
        return $this->orderItemId;
    }

    /**
     * @param int|null $orderItemId
     */
    public function setOrderItemId(?int $orderItemId): void
    {
        $this->orderItemId = $orderItemId;
    }

    /**
     * @return int
     */
    public function getOrderItemSku(): int
    {
        return $this->orderItemSku;
    }

    /**
     * @param int $orderItemSku
     */
    public function setOrderItemSku(int $orderItemSku): void
    {
        $this->orderItemSku = $orderItemSku;
    }

    /**
     * @return string
     */
    public function getOrderItemName(): string
    {
        return $this->orderItemName;
    }

    /**
     * @param string $orderItemName
     */
    public function setOrderItemName(string $orderItemName): void
    {
        $this->orderItemName = $orderItemName;
    }

    /**
     * @return int
     */
    public function getOrderItemQuantity(): int
    {
        return $this->orderItemQuantity;
    }

    /**
     * @param int $orderItemQuantity
     */
    public function setOrderItemQuantity(int $orderItemQuantity): void
    {
        $this->orderItemQuantity = $orderItemQuantity;
    }

    /**
     * @return string|null
     */
    public function getOrderItemPrice(): ?string
    {
        return $this->orderItemPrice;
    }

    /**
     * @param string|null $orderItemPrice
     */
    public function setOrderItemPrice(?string $orderItemPrice): void
    {
        $this->orderItemPrice = $orderItemPrice;
    }

    /**
     * @return string|null
     */
    public function getOrderItemPriceWithoutTax(): ?string
    {
        return $this->orderItemPriceWithoutTax;
    }

    /**
     * @param string|null $orderItemPriceWithoutTax
     */
    public function setOrderItemPriceWithoutTax(?string $orderItemPriceWithoutTax): void
    {
        $this->orderItemPriceWithoutTax = $orderItemPriceWithoutTax;
    }

    /**
     * @return string|null
     */
    public function getOrderItemTax(): ?string
    {
        return $this->orderItemTax;
    }

    /**
     * @param string|null $orderItemTax
     */
    public function setOrderItemTax(?string $orderItemTax): void
    {
        $this->orderItemTax = $orderItemTax;
    }

    /**
     * @return string|null
     */
    public function getOrderItemBasePriceWithTax(): ?string
    {
        return $this->orderItemBasePriceWithTax;
    }

    /**
     * @param string|null $orderItemBasePriceWithTax
     */
    public function setOrderItemBasePriceWithTax(?string $orderItemBasePriceWithTax): void
    {
        $this->orderItemBasePriceWithTax = $orderItemBasePriceWithTax;
    }

    /**
     * @return string|null
     */
    public function getOrderItemDiscountedPriceWithoutTax(): ?string
    {
        return $this->orderItemDiscountedPriceWithoutTax;
    }

    /**
     * @param string|null $orderItemDiscountedPriceWithoutTax
     */
    public function setOrderItemDiscountedPriceWithoutTax(?string $orderItemDiscountedPriceWithoutTax): void
    {
        $this->orderItemDiscountedPriceWithoutTax = $orderItemDiscountedPriceWithoutTax;
    }

    /**
     * @return string|null
     */
    public function getOrderItemFinalPrice(): ?string
    {
        return $this->orderItemFinalPrice;
    }

    /**
     * @param string|null $orderItemFinalPrice
     */
    public function setOrderItemFinalPrice(?string $orderItemFinalPrice): void
    {
        $this->orderItemFinalPrice = $orderItemFinalPrice;
    }

    /**
     * @return string|null
     */
    public function getOrderItemSubtotalDiscount(): ?string
    {
        return $this->orderItemSubtotalDiscount;
    }

    /**
     * @param string|null $orderItemSubtotalDiscount
     */
    public function setOrderItemSubtotalDiscount(?string $orderItemSubtotalDiscount): void
    {
        $this->orderItemSubtotalDiscount = $orderItemSubtotalDiscount;
    }

    /**
     * @return string|null
     */
    public function getOrderItemSubtotalWithTax(): ?string
    {
        return $this->orderItemSubtotalWithTax;
    }

    /**
     * @param string|null $orderItemSubtotalWithTax
     */
    public function setOrderItemSubtotalWithTax(?string $orderItemSubtotalWithTax): void
    {
        $this->orderItemSubtotalWithTax = $orderItemSubtotalWithTax;
    }

    /**
     * @return int|null
     */
    public function getOrderItemOrderCurrency(): ?int
    {
        return $this->orderItemOrderCurrency;
    }

    /**
     * @param int|null $orderItemOrderCurrency
     */
    public function setOrderItemOrderCurrency(?int $orderItemOrderCurrency): void
    {
        $this->orderItemOrderCurrency = $orderItemOrderCurrency;
    }

    /**
     * @return string|null
     */
    public function getOrderItemAttribute(): ?string
    {
        return $this->orderItemAttribute;
    }

    /**
     * @param string|null $orderItemAttribute
     */
    public function setOrderItemAttribute(?string $orderItemAttribute): void
    {
        $this->orderItemAttribute = $orderItemAttribute;
    }

    /**
     * @return string|null
     */
    public function getOrderItemHash(): ?string
    {
        return $this->orderItemHash;
    }

    /**
     * @param string|null $orderItemHash
     */
    public function setOrderItemHash(?string $orderItemHash): void
    {
        $this->orderItemHash = $orderItemHash;
    }

    /**
     * @return Vendor
     */
    public function getOrderItem(): Vendor
    {
        return $this->orderItem;
    }

    /**
     * @param Vendor $orderItem
     */
    public function setOrderItem(Vendor $orderItem): void
    {
        $this->orderItem = $orderItem;
    }

    /**
     * @return OrderStorage
     */
    public function getOrderItemStorage(): OrderStorage
    {
        return $this->orderItemStorage;
    }

    /**
     * @param OrderStorage $orderItemStorage
     */
    public function setOrderItemStorage(OrderStorage $orderItemStorage): void
    {
        $this->orderItemStorage = $orderItemStorage;
    }

    /**
     * @return Product
     */
    public function getOrderItemOrdered(): Product
    {
        return $this->orderItemOrdered;
    }

    /**
     * @param Product $orderItemOrdered
     */
    public function setOrderItemOrdered(Product $orderItemOrdered): void
    {
        $this->orderItemOrdered = $orderItemOrdered;
    }


}

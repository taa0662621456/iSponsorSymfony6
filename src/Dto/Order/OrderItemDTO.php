<?php

namespace App\Dto\Order;

use ApiPlatform\Metadata\ApiResource;
use App\Dto\Abstraction\ObjectDTO;
use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\DBAL\Types\TextType;

#[ApiResource(mercure: true)]
final class OrderItemDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private ?int $itemId = null;

    private int $itemSku = 1;

    private string $itemName = 'item_name';

    private int $itemQuantity = 1;

    private ?int $itemPrice = null;

    private ?int $itemPriceWithoutTax = null;

    private ?int $itemTax = null;

    private ?int $itemBasePriceWithTax = null;

    private ?int $itemDiscountedPriceWithoutTax = null;

    private string $itemFinalPrice = '0.00000';

    private string $itemSubtotalDiscount = '0.00000';

    private string $itemSubtotalWithTax = '0.00000';

    private ?int $itemOrderCurrency = null;

    private ?string $itemAttribute = null;

    private ?string $itemHash = null;

    private Vendor $orderItemsVendorDTO;

    private OrderStorage $orderItemDTO;

    private Product $productOrderedDTO;

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
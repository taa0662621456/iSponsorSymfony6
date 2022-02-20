<?php


namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'orders_items')]
#[ORM\Index(name: 'order_item_idx', columns: ['slug'])]
#[ORM\Entity(repositoryClass: \App\Repository\Order\OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderItem
{
	use BaseTrait;

	#[ORM\Column(name: 'item_id', type: 'integer', nullable: true, options: ['default' => 0])]
	private int $itemId = 0;

	#[ORM\Column(name: 'item_sku', type: 'integer', nullable: false, options: ['default' => 1])]
	private int $itemSku = 1;

	#[ORM\Column(name: 'item_name', type: 'string', nullable: false, options: ['default' => ''])]
	private string $itemName = 'item_name';

	#[ORM\Column(name: 'item_quantity', type: 'integer', nullable: true, options: ['default' => 0])]
	private ?int $itemQuantity = 1;

	#[ORM\Column(name: 'item_price', type: 'decimal', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
	private ?int $itemPrice = 1;

	#[ORM\Column(name: 'item_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
	private ?int $itemPriceWithoutTax = 0;

	#[ORM\Column(name: 'item_tax', type: 'decimal', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
	private ?int $itemTax = 0;

	#[ORM\Column(name: 'item_base_price_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
	private ?int $itemBasePriceWithTax = 0;

	#[ORM\Column(name: 'item_discounted_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true, options: ['default' => 0])]
	private ?int $itemDiscountedPriceWithoutTax = 0;
	/**
	 * @var
	 */
	#[ORM\Column(name: 'item_final_price', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
	private string $itemFinalPrice = '0.00000';
	/**
	 * @var
	 */
	#[ORM\Column(name: 'item_subtotal_discount', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
	private string $itemSubtotalDiscount = '0.00000';
	/**
	 * @var
	 */
	#[ORM\Column(name: 'item_subtotal_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
	private string $itemSubtotalWithTax = '0.00000';
	#[ORM\Column(name: 'item_order_currency', type: 'integer', nullable: true, options: ['default' => 0])]
	private ?int $itemOrderCurrency = 0;
	#[ORM\Column(name: 'item_attribute', type: 'text', nullable: true, options: ['default' => 'item_attribute'])]
	private string|\Doctrine\DBAL\Types\TextType $itemAttribute = 'item_attribute';
	#[ORM\Column(name: 'item_hash', type: 'string', nullable: true, options: ['default' => 'item_hash'])]
	private string $itemHash = 'item_hash';
	#[ORM\ManyToOne(targetEntity: \App\Entity\Vendor\Vendor::class, inversedBy: 'vendorItems')]
	#[ORM\JoinColumn(name: 'itemVendors_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private Vendor $itemVendors;
	#[ORM\ManyToOne(targetEntity: \App\Entity\Order\Order::class, inversedBy: 'orderItems')]
	private Order $items;
	#[ORM\ManyToOne(targetEntity: \App\Entity\Product\Product::class, inversedBy: 'productOrdered')]
	private Product $productOrdered;
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
	/**
	 * @param int $itemSku
	 */
	public function setItemSku(?int $itemSku): void
 {
     $this->itemSku = $itemSku;
 }
	public function getItemName(): string
 {
     return $this->itemName;
 }
	/**
	 * @param string $itemName
	 */
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
	/**
	 * @return null
	 */
	public function getItemPrice()
 {
     return $this->itemPrice;
 }
	/**
	 * @param null $itemPrice
	 */
	public function setItemPrice($itemPrice): void
 {
     $this->itemPrice = $itemPrice;
 }
	/**
	 * @return null
	 */
	public function getItemPriceWithoutTax()
 {
     return $this->itemPriceWithoutTax;
 }
	/**
	 * @param null $itemPriceWithoutTax
	 */
	public function setItemPriceWithoutTax($itemPriceWithoutTax): void
 {
     $this->itemPriceWithoutTax = $itemPriceWithoutTax;
 }
	/**
	 * @return null
	 */
	public function getItemTax()
 {
     return $this->itemTax;
 }
	/**
	 * @param null $itemTax
	 */
	public function setItemTax($itemTax): void
 {
     $this->itemTax = $itemTax;
 }
	/**
	 * @return null
	 */
	public function getItemBasePriceWithTax()
 {
     return $this->itemBasePriceWithTax;
 }
	/**
	 * @param null $itemBasePriceWithTax
	 */
	public function setItemBasePriceWithTax($itemBasePriceWithTax): void
 {
     $this->itemBasePriceWithTax = $itemBasePriceWithTax;
 }
	/**
	 * @return null
	 */
	public function getItemDiscountedPriceWithoutTax()
 {
     return $this->itemDiscountedPriceWithoutTax;
 }
	/**
	 * @param null $itemDiscountedPriceWithoutTax
	 */
	public function setItemDiscountedPriceWithoutTax($itemDiscountedPriceWithoutTax): void
 {
     $this->itemDiscountedPriceWithoutTax = $itemDiscountedPriceWithoutTax;
 }
	/**
	 * @return
	 */
	public function getItemFinalPrice()
 {
     return $this->itemFinalPrice;
 }
	/**
	 * @param $itemFinalPrice
	 */
	public function setItemFinalPrice($itemFinalPrice): void
 {
     $this->itemFinalPrice = $itemFinalPrice;
 }
	/**
	 * @return
	 */
	public function getItemSubtotalDiscount()
 {
     return $this->itemSubtotalDiscount;
 }
	/**
	 * @param $itemSubtotalDiscount
	 */
	public function setItemSubtotalDiscount($itemSubtotalDiscount): void
 {
     $this->itemSubtotalDiscount = $itemSubtotalDiscount;
 }
	/**
	 * @return
	 */
	public function getItemSubtotalWithTax()
 {
     return $this->itemSubtotalWithTax;
 }
	/**
	 * @param $itemSubtotalWithTax
	 */
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
	public function getItemAttribute(): ?TextType
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
	/**
	 * @return
	 */
	public function getItemVendors()
	{
		return $this->itemVendors;
	}
	/**
	 * @param $itemVendors
	 */
	public function setItemVendors($itemVendors): void
	{
		$this->itemVendors = $itemVendors;
	}
	/**
	 * @return
	 */
	public function getItems()
	{
		return $this->items;
	}
	/**
	 * @param $items
	 */
	public function setItems($items): void
	{
		$this->items = $items;
	}
	/**
	 * @return
	 */
	public function getProductOrdered()
	{
		return $this->productOrdered;
	}
	/**
	 * @param $productOrdered
	 */
	public function setProductOrdered($productOrdered): void
	{
		$this->productOrdered = $productOrdered;
	}
}

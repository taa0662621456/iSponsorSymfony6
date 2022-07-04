<?php


namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use App\Repository\Order\OrderRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'orders_items')]
#[ORM\Index(columns: ['slug'], name: 'order_item_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderItem
{
	use BaseTrait;

	#[ORM\Column(name: 'item_id')]
	private ?int $itemId = null;

	#[ORM\Column(name: 'item_sku', type: 'integer', nullable: false, options: ['default' => 1])]
	private int $itemSku = 1;

	#[ORM\Column(name: 'item_name', type: 'string', nullable: false, options: ['default' => ''])]
	private string $itemName = 'item_name';

	#[ORM\Column(name: 'item_quantity', type: 'integer', nullable: false, options: ['default' => 1])]
	private int $itemQuantity = 1;

	#[ORM\Column(name: 'item_price', type: 'decimal', precision: 7, scale: 2)]
	private ?int $itemPrice = null;

	#[ORM\Column(name: 'item_price_without_tax', type: 'decimal', precision: 7, scale: 2)]
	private ?int $itemPriceWithoutTax = null;

	#[ORM\Column(name: 'item_tax', type: 'decimal', precision: 7, scale: 2)]
	private ?int $itemTax = null;

	#[ORM\Column(name: 'item_base_price_with_tax', type: 'decimal', precision: 7, scale: 2)]
	private ?int $itemBasePriceWithTax = null;

	#[ORM\Column(name: 'item_discounted_price_without_tax', type: 'decimal', precision: 7, scale: 2)]
	private ?int $itemDiscountedPriceWithoutTax = null;
	/**
	 * @var string
     */
	#[ORM\Column(name: 'item_final_price', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
	private string $itemFinalPrice = '0.00000';
	/**
	 * @var string
     */
	#[ORM\Column(name: 'item_subtotal_discount', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
	private string $itemSubtotalDiscount = '0.00000';
	/**
	 * @var string
     */
	#[ORM\Column(name: 'item_subtotal_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
	private string $itemSubtotalWithTax = '0.00000';
	#[ORM\Column(name: 'item_order_currency')]
	private ?int $itemOrderCurrency = null;
	#[ORM\Column(name: 'item_attribute')]
	private ?string $itemAttribute = null;
	#[ORM\Column(name: 'item_hash')]
	private ?string $itemHash = null;
	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorItems')]
	#[ORM\JoinColumn(name: 'itemVendors_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
	private Vendor $itemVendors;
	#[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderItems')]
	private Order $items;
	#[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productOrdered')]
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
     * @param int|null $itemSku
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
     * @param string|null $itemName
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
     * @return int|null
     */
	public function getItemPrice(): ?int
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
     * @return int|null
     */
	public function getItemPriceWithoutTax(): ?int
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
     * @return int|null
     */
	public function getItemTax(): ?int
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
     * @return int|null
     */
	public function getItemBasePriceWithTax(): ?int
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
     * @return int|null
     */
	public function getItemDiscountedPriceWithoutTax(): ?int
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
     * @return string
     */
	public function getItemFinalPrice(): string
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
     * @return string
     */
	public function getItemSubtotalDiscount(): string
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
     * @return string
     */
	public function getItemSubtotalWithTax(): string
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

    /**
     * @return Vendor
     */
	public function getItemVendors(): Vendor
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
     * @return Order
     */
	public function getItems(): Order
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
     * @return Product
     */
	public function getProductOrdered(): Product
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

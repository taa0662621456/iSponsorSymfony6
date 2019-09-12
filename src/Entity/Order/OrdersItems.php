<?php
declare(strict_types=1);

namespace App\Entity\Order;

use DateTime;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * OrderItems
 *
 * @ORM\Table(name="order_items")
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class OrdersItems
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
	 * @var integer
	 *
	 * @ORM\Column(name="item", type="integer", nullable=false, options={"default":0})
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_sku", type="integer", nullable=false, options={"default":0})
     */
    private $itemSku = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="item_name", type="string", nullable=false, options={"default"=""})
     */
    private $itemName = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="item_quantity", type="integer", nullable=true, options={"default":0})
     */
    private $itemQuantity = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="item_price", type="decimal", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $itemPrice = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="item_price_without_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $itemPriceWithoutTax = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="item_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $itemTax = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="item_base_price_with_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $itemBasePriceWithTax = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="item_discounted_price_without_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $itemDiscountedPriceWithoutTax = 0;

    /**
     * @var 
     *
     * @ORM\Column(name="item_final_price", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=false, options={"default"="0.00000"})
     */
    private $itemFinalPrice = '0.00000';

    /**
     * @var 
     *
     * @ORM\Column(name="item_subtotal_discount", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=false, options={"default"="0.00000"})
     */
    private $itemSubtotalDiscount = '0.00000';

    /**
     * @var 
     *
     * @ORM\Column(name="item_subtotal_with_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=false, options={"default"="0.00000"})
     */
    private $itemSubtotalWithTax = '0.00000';

    /**
     * @var int|null
     *
     * @ORM\Column(name="item_order_currency", type="integer", nullable=true, options={"default":0})
     */
    private $itemOrderCurrency = 0;

    /**
     * @var TextType
     *
     * @ORM\Column(name="item_attribute", type="text", nullable=true, options={"default"="item_attribute"})
     */
    private $itemAttribute = 'item_attribute';

    /**
     * @var string
     *
     * @ORM\Column(name="item_hash", type="string", nullable=true, options={"default"="item_hash"})
     */
    private $itemHash = 'item_hash';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false)
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false)
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\Orders", inversedBy="orderItems")
	 * @ORM\JoinColumn(name="id", referencedColumnName="id")
	 */
    private $orderItems;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors", inversedBy="vendorOrderItems")
	 */
    private $vendorOrderItems;














    /**
     * OrdersItems constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->lockedOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->createdOn = new \DateTime();
    }



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getItem(): ?int
    {
        return $this->item;
    }

    /**
     * @param int|null $item
     */
    public function setItem(?int $item): void
    {
        $this->item = $item;
    }

    /**
     * @return int
     */
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

    /**
     * @return string
     */
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

    /**
     * @return int|null
     */
    public function getItemQuantity(): ?int
    {
        return $this->itemQuantity;
    }

    /**
     * @param int|null $itemQuantity
     */
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
     * @return mixed
     */
    public function getItemFinalPrice()
    {
        return $this->itemFinalPrice;
    }

    /**
     * @param mixed $itemFinalPrice
     */
    public function setItemFinalPrice($itemFinalPrice): void
    {
        $this->itemFinalPrice = $itemFinalPrice;
    }

    /**
     * @return mixed
     */
    public function getItemSubtotalDiscount()
    {
        return $this->itemSubtotalDiscount;
    }

    /**
     * @param mixed $itemSubtotalDiscount
     */
    public function setItemSubtotalDiscount($itemSubtotalDiscount): void
    {
        $this->itemSubtotalDiscount = $itemSubtotalDiscount;
    }

    /**
     * @return mixed
     */
    public function getItemSubtotalWithTax()
    {
        return $this->itemSubtotalWithTax;
    }

    /**
     * @param mixed $itemSubtotalWithTax
     */
    public function setItemSubtotalWithTax($itemSubtotalWithTax): void
    {
        $this->itemSubtotalWithTax = $itemSubtotalWithTax;
    }

    /**
     * @return int|null
     */
    public function getItemOrderCurrency(): ?int
    {
        return $this->itemOrderCurrency;
    }

    /**
     * @param int|null $itemOrderCurrency
     */
    public function setItemOrderCurrency(?int $itemOrderCurrency): void
    {
        $this->itemOrderCurrency = $itemOrderCurrency;
    }

    /**
     * @return TextType|null
     */
    public function getItemAttribute(): ?TextType
    {
        return $this->itemAttribute;
    }

    /**
     * @param TextType|null $itemAttribute
     */
    public function setItemAttribute(?TextType $itemAttribute): void
    {
        $this->itemAttribute = $itemAttribute;
    }

    /**
     * @return string|null
     */
    public function getItemHash(): ?string
    {
        return $this->itemHash;
    }

    /**
     * @param string|null $itemHash
     */
    public function setItemHash(?string $itemHash): void
    {
        $this->itemHash = $itemHash;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    /**
     * @param DateTime $createdOn
     */
    public function setCreatedOn(DateTime $createdOn): void
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy(?int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTime
     */
    public function getModifiedOn(): DateTime
    {
        return $this->modifiedOn;
    }

    /**
     * @param DateTime $modifiedOn
     */
    public function setModifiedOn(DateTime $modifiedOn): void
    {
        $this->modifiedOn = $modifiedOn;
    }

    /**
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
     */
    public function setModifiedBy(?int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param DateTime $lockedOn
     */
    public function setLockedOn(DateTime $lockedOn): void
    {
        $this->lockedOn = $lockedOn;
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(?int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }

	/**
	 * @return mixed
	 */
	public function getOrderItems()
	{
		return $this->orderItems;
	}

	/**
	 * @param mixed $orderItems
	 */
	public function setOrderItems($orderItems): void
	{
		$this->orderItems = $orderItems;
	}

	/**
	 * @return mixed
	 */
	public function getVendorOrderItems()
	{
		return $this->vendorOrderItems;
	}

	/**
	 * @param mixed $vendorOrderItems
	 */
	public function setVendorOrderItems($vendorOrderItems): void
	{
		$this->vendorOrderItems = $vendorOrderItems;
	}
}

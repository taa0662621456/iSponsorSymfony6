<?php
declare(strict_types=1);

namespace App\Entity\Order;

use ApiPlatform\Core\Annotation\ApiResource;
use DateTime;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * OrderItems
 *
 * @ORM\Table(name="order_items", indexes={
 *     @ORM\Index(name="order_status", columns={"order_status"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource()
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Order\Orders", inversedBy="orderItems")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product\Products", inversedBy="productOrdered")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="order_item_sku", type="string", nullable=false, options={"default"=""})
     */
    private $orderItemSku = '';

    /**
     * @var string
     *
     * @ORM\Column(name="order_item_name", type="string", nullable=false, options={"default"=""})
     */
    private $orderItemName = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_quantity", type="integer", nullable=true, options={"default":0})
     */
    private $productQuantity = '0';

    /**
     * @var null
     *
     * @ORM\Column(name="product_item_price", type="decimal", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productItemPrice = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="product_price_without_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productPriceWithoutTax = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="product_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productTax = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="product_base_price_with_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productBasePriceWithTax = 0;

    /**
     * @var null
     *
     * @ORM\Column(name="product_discounted_price_without_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productDiscountedPriceWithoutTax = 0;

    /**
     * @var 
     *
     * @ORM\Column(name="product_final_price", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=false, options={"default"="0.00000"})
     */
    private $productFinalPrice = '0.00000';

    /**
     * @var 
     *
     * @ORM\Column(name="product_subtotal_discount", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=false, options={"default"="0.00000"})
     */
    private $productSubtotalDiscount = '0.00000';

    /**
     * @var 
     *
     * @ORM\Column(name="product_subtotal_with_tax", type="decimal", precision=7, scale=2, precision=7, scale=2, nullable=false, options={"default"="0.00000"})
     */
    private $productSubtotalWithTax = '0.00000';

    /**
     * @var int|null
     *
     * @ORM\Column(name="order_item_currency", type="integer", nullable=true, options={"default":0})
     */
    private $orderItemCurrency = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_status", type="string", nullable=true, options={"default"="0"})
     */
    private $orderStatus = '0';

    /**
     * @var TextType|null
     *
     * @ORM\Column(name="product_attribute", type="text", nullable=true, options={"default"="product_attribute"})
     */
    private $productAttribute = 'product_attribute';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="delivery_date", type="string", nullable=true)
     */
    private $deliveryDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="oi_hash", type="string", nullable=true, options={"default"="oi_hash"})
     */
    private $oiHash = 'oi_hash';

    /**
     * @var DateTime
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
     * @var DateTime
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
     * @var DateTime
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
     * @return Orders
     */
    public function getOrder(): Orders
    {
        return $this->order;
    }

    /**
     * @param Orders
     */
    public function setOrder(Orders $order = null): void
    {
        $this->order = $order;
    }


    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     */
    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getOrderItemSku(): string
    {
        return $this->orderItemSku;
    }

    /**
     * @param string $orderItemSku
     */
    public function setOrderItemSku(string $orderItemSku): void
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
     * @return int|null
     */
    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    /**
     * @param int|null $productQuantity
     */
    public function setProductQuantity(?int $productQuantity): void
    {
        $this->productQuantity = $productQuantity;
    }

    /**
     * @return null
     */
    public function getProductItemPrice()
    {
        return $this->productItemPrice;
    }

    /**
     * @param null $productItemPrice
     */
    public function setProductItemPrice($productItemPrice): void
    {
        $this->productItemPrice = $productItemPrice;
    }

    /**
     * @return null
     */
    public function getProductPriceWithoutTax()
    {
        return $this->productPriceWithoutTax;
    }

    /**
     * @param null $productPriceWithoutTax
     */
    public function setProductPriceWithoutTax($productPriceWithoutTax): void
    {
        $this->productPriceWithoutTax = $productPriceWithoutTax;
    }

    /**
     * @return null
     */
    public function getProductTax()
    {
        return $this->productTax;
    }

    /**
     * @param null $productTax
     */
    public function setProductTax($productTax): void
    {
        $this->productTax = $productTax;
    }

    /**
     * @return null
     */
    public function getProductBasePriceWithTax()
    {
        return $this->productBasePriceWithTax;
    }

    /**
     * @param null $productBasePriceWithTax
     */
    public function setProductBasePriceWithTax($productBasePriceWithTax): void
    {
        $this->productBasePriceWithTax = $productBasePriceWithTax;
    }

    /**
     * @return null
     */
    public function getProductDiscountedPriceWithoutTax()
    {
        return $this->productDiscountedPriceWithoutTax;
    }

    /**
     * @param null $productDiscountedPriceWithoutTax
     */
    public function setProductDiscountedPriceWithoutTax($productDiscountedPriceWithoutTax): void
    {
        $this->productDiscountedPriceWithoutTax = $productDiscountedPriceWithoutTax;
    }

    /**
     * @return mixed
     */
    public function getProductFinalPrice()
    {
        return $this->productFinalPrice;
    }

    /**
     * @param mixed $productFinalPrice
     */
    public function setProductFinalPrice($productFinalPrice): void
    {
        $this->productFinalPrice = $productFinalPrice;
    }

    /**
     * @return mixed
     */
    public function getProductSubtotalDiscount()
    {
        return $this->productSubtotalDiscount;
    }

    /**
     * @param mixed $productSubtotalDiscount
     */
    public function setProductSubtotalDiscount($productSubtotalDiscount): void
    {
        $this->productSubtotalDiscount = $productSubtotalDiscount;
    }

    /**
     * @return mixed
     */
    public function getProductSubtotalWithTax()
    {
        return $this->productSubtotalWithTax;
    }

    /**
     * @param mixed $productSubtotalWithTax
     */
    public function setProductSubtotalWithTax($productSubtotalWithTax): void
    {
        $this->productSubtotalWithTax = $productSubtotalWithTax;
    }

    /**
     * @return int|null
     */
    public function getOrderItemCurrency(): ?int
    {
        return $this->orderItemCurrency;
    }

    /**
     * @param int|null $orderItemCurrency
     */
    public function setOrderItemCurrency(?int $orderItemCurrency): void
    {
        $this->orderItemCurrency = $orderItemCurrency;
    }

    /**
     * @return string|null
     */
    public function getOrderStatus(): ?string
    {
        return $this->orderStatus;
    }

    /**
     * @param string|null $orderStatus
     */
    public function setOrderStatus(?string $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return TextType|null
     */
    public function getProductAttribute(): ?TextType
    {
        return $this->productAttribute;
    }

    /**
     * @param TextType|null $productAttribute
     */
    public function setProductAttribute(?TextType $productAttribute): void
    {
        $this->productAttribute = $productAttribute;
    }

    /**
     * @return DateTime
     */
    public function getDeliveryDate(): DateTime
    {
        return $this->deliveryDate;
    }

    /**
     * @param DateTime $deliveryDate
     */
    public function setDeliveryDate(DateTime $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @return string|null
     */
    public function getOiHash(): ?string
    {
        return $this->oiHash;
    }

    /**
     * @param string|null $oiHash
     */
    public function setOiHash(?string $oiHash): void
    {
        $this->oiHash = $oiHash;
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
    public function setCreatedBy(int $createdBy): void
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
    public function setModifiedBy(int $modifiedBy): void
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
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }



















}

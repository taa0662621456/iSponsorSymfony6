<?php
declare(strict_types=1);

namespace App\Entity\Order;

use App\Entity\BaseTrait;

use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="orders", indexes={
 * @ORM\Index(name="order_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Orders
{
	use BaseTrait;

	public const NUM_ITEMS = 10;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_number", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderNumber = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_customer_number", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderCustomerNumber = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_pass", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderPass = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_create_invoice_pass", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderCreateInvoicePass = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_total", type="decimal", nullable=false, options={"default"="0.00000"})
	 */
	private $orderTotal = '0.00000';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_sales_price", type="decimal", nullable=false, options={"default"="0.00000"})
	 */
	private $orderSalesPrice = '0.00000';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_bill_tax_amount", type="decimal", nullable=false, options={"default"="0.00000"})
	 */
	private $orderBillTaxAmount = '0.00000';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_bill_tax", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderBillTax = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_bill_discount_amount", type="decimal", nullable=false, options={"default"="0.00000"})
	 */
	private $orderBillDiscountAmount = '0.00000';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_discount_amount", type="decimal", nullable=false, options={"default"="0.00000"})
	 */
	private $orderBillDiscount = '0.00000';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_subtotal", type="decimal", nullable=true, options={"default" : 0})
	 */
	private $orderSubtotal = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_tax", type="decimal", nullable=true, options={"default" : 0})
	 */
	private $orderTax = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_shipment", type="decimal", nullable=true, options={"default" : 0})
	 */
	private $orderShipment = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_shipment_tax", type="decimal", nullable=true, options={"default" : 0})
	 */
	private $orderShipmentTax = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_payment", type="decimal", nullable=true, options={"default" : 0})
	 */
	private $orderPayment = '0';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_payment_tax", type="decimal", nullable=true, options={"default" : 0})
	 */
	private $orderPaymentTax = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_coupon_discount", type="decimal", nullable=false, options={"default"="0.00"})
	 */
	private $orderCouponDiscount = '0.00';

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_coupon_code", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderCouponCode = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_discount", type="decimal", nullable=false, options={"default"="0.00"})
	 */
	private $orderDiscount = '0.00';

	/**
	 * @var int|null
	 *
	 * @ORM\Column(name="order_currency", type="smallint", nullable=true, options={"default" : 0})
	 */
	private $orderCurrency = 0;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_currency_rate", type="decimal", nullable=false, options={"default"="1.000000"})
	 */
	private $orderCurrencyRate = '1.000000';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_shopper_groups", type="string", nullable=true, options={"default"="0"})
	 */
	private $orderShopperGroups = '0';

	/**
	 * @var int|null
	 *
	 * @ORM\Column(name="order_payment_currency_id", type="smallint", nullable=true, options={"default" : 0})
	 */
	private $orderPaymentCurrencyId = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_payment_currency_rate", type="decimal", nullable=false, options={"default"="1.000000"})
	 */
	private $orderPaymentCurrencyRate = '1.000000';

	/**
	 * @var integer|null
	 *
	 * @ORM\Column(name="order_payment_method_id", type="integer", nullable=true, options={"default" : 0})
	 */
	private $orderPaymentMethodId = 0;

	/**
	 * @var integer|null
	 *
	 * @ORM\Column(name="order_shipment_method_id", type="integer", nullable=true, options={"default" : 0})
	 */
	private $orderShipmentMethodId = '0';

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="order_delivery_date", type="datetime", nullable=true)
	 */
	private $orderDeliveryDate;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_language", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderLanguage = '0';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="order_ip_address", type="string", nullable=false, options={"default"="''"})
	 */
	private $orderIpAddress = '';

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="orderSTSameAsBT", type="boolean", nullable=false)
	 */
	private $orderSTSameAsBT = false;

	/**
	 * @var string|null
	 *
	 * @ORM\Column(name="order_hash", type="string", nullable=true, options={"default" : 0})
	 */
	private $orderHash = '0';

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Order\OrdersItems",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="items",
	 *     orphanRemoval=true,
	 *     fetch="EXTRA_LAZY"
	 * )
	 * @Assert\Type(type="App\Entity\Order\Orders")
	 * @Assert\Valid()
	 **/
	private $orderItems;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Order\OrdersStatus",
	 *     inversedBy="orders",
	 *     fetch="EXTRA_LAZY")
	 * @ORM\JoinColumn(name="orderStatus_id", referencedColumnName="id")
	 */
	private $orderStatus;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors",
	 *     inversedBy="vendorOrders")
	 */
	private $orderCreatedAt;

	public function __construct()
	{
		$this->orderDeliveryDate = new DateTime();
		$this->orderItems = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getOrderId(): int
	{
		return $this->id;
	}

	/**
	 * @return string|null
	 */
	public function getOrderNumber(): ?string
	{
		return $this->orderNumber;
	}

	/**
	 * @param string|null $orderNumber
	 */
	public function setOrderNumber(?string $orderNumber): void
	{
		$this->orderNumber = $orderNumber;
	}

	/**
	 * @return string|null
	 */
	public function getOrderCustomerNumber(): ?string
	{
		return $this->orderCustomerNumber;
	}

	/**
	 * @param string|null $orderCustomerNumber
	 */
	public function setOrderCustomerNumber(?string $orderCustomerNumber): void
	{
		$this->orderCustomerNumber = $orderCustomerNumber;
	}

	/**
	 * @return string|null
	 */
	public function getOrderPass(): ?string
	{
		return $this->orderPass;
	}

	/**
	 * @param string|null $orderPass
	 */
	public function setOrderPass(?string $orderPass): void
	{
		$this->orderPass = $orderPass;
	}

	/**
	 * @return string|null
	 */
	public function getOrderCreateInvoicePass(): ?string
	{
		return $this->orderCreateInvoicePass;
	}

	/**
	 * @param string|null $orderCreateInvoicePass
	 */
	public function setOrderCreateInvoicePass(?string $orderCreateInvoicePass): void
	{
		$this->orderCreateInvoicePass = $orderCreateInvoicePass;
	}

	/**
	 * @return string
	 */
	public function getOrderTotal(): string
	{
		return $this->orderTotal;
	}

	/**
	 * @param string $orderTotal
	 */
	public function setOrderTotal(string $orderTotal): void
	{
		$this->orderTotal = $orderTotal;
	}

	/**
	 * @return string
	 */
	public function getOrderSalesPrice(): string
	{
		return $this->orderSalesPrice;
	}

	/**
	 * @param string $orderSalesPrice
	 */
	public function setOrderSalesPrice(string $orderSalesPrice): void
	{
		$this->orderSalesPrice = $orderSalesPrice;
	}

	/**
	 * @return string
	 */
	public function getOrderBillTaxAmount(): string
	{
		return $this->orderBillTaxAmount;
	}

	/**
	 * @param string $orderBillTaxAmount
	 */
	public function setOrderBillTaxAmount(string $orderBillTaxAmount): void
	{
		$this->orderBillTaxAmount = $orderBillTaxAmount;
	}

	/**
	 * @return string|null
	 */
	public function getOrderBillTax(): ?string
	{
		return $this->orderBillTax;
	}

	/**
	 * @param string|null $orderBillTax
	 */
	public function setOrderBillTax(?string $orderBillTax): void
	{
		$this->orderBillTax = $orderBillTax;
	}

	/**
	 * @return string
	 */
	public function getOrderBillDiscountAmount(): string
	{
		return $this->orderBillDiscountAmount;
	}

	/**
	 * @param string $orderBillDiscountAmount
	 */
	public function setOrderBillDiscountAmount(string $orderBillDiscountAmount): void
	{
		$this->orderBillDiscountAmount = $orderBillDiscountAmount;
	}

	/**
	 * @return string
	 */
	public function getOrderBillDiscount(): string
	{
		return $this->orderBillDiscount;
	}

	/**
	 * @param string $orderBillDiscount
	 */
	public function setOrderBillDiscount(string $orderBillDiscount): void
	{
		$this->orderBillDiscount = $orderBillDiscount;
	}

	/**
	 * @return string|null
	 */
	public function getOrderSubtotal(): ?string
	{
		return $this->orderSubtotal;
	}

	/**
	 * @param string|null $orderSubtotal
	 */
	public function setOrderSubtotal(?string $orderSubtotal): void
	{
		$this->orderSubtotal = $orderSubtotal;
	}

	/**
	 * @return string|null
	 */
	public function getOrderTax(): ?string
	{
		return $this->orderTax;
	}

	/**
	 * @param string|null $orderTax
	 */
	public function setOrderTax(?string $orderTax): void
	{
		$this->orderTax = $orderTax;
	}

	/**
	 * @return string|null
	 */
	public function getOrderShipment(): ?string
	{
		return $this->orderShipment;
	}

	/**
	 * @param string|null $orderShipment
	 */
	public function setOrderShipment(?string $orderShipment): void
	{
		$this->orderShipment = $orderShipment;
	}

	/**
	 * @return string|null
	 */
	public function getOrderShipmentTax(): ?string
	{
		return $this->orderShipmentTax;
	}

	/**
	 * @param string|null $orderShipmentTax
	 */
	public function setOrderShipmentTax(?string $orderShipmentTax): void
	{
		$this->orderShipmentTax = $orderShipmentTax;
	}

	/**
	 * @return string|null
	 */
	public function getOrderPayment(): ?string
	{
		return $this->orderPayment;
	}

	/**
	 * @param string|null $orderPayment
	 */
	public function setOrderPayment(?string $orderPayment): void
	{
		$this->orderPayment = $orderPayment;
	}

	/**
	 * @return string|null
	 */
	public function getOrderPaymentTax(): ?string
	{
		return $this->orderPaymentTax;
	}

	/**
	 * @param string|null $orderPaymentTax
	 */
	public function setOrderPaymentTax(?string $orderPaymentTax): void
	{
		$this->orderPaymentTax = $orderPaymentTax;
	}

	/**
	 * @return string
	 */
	public function getOrderCouponDiscount(): string
	{
		return $this->orderCouponDiscount;
	}

	/**
	 * @param string $orderCouponDiscount
	 */
	public function setOrderCouponDiscount(string $orderCouponDiscount): void
	{
		$this->orderCouponDiscount = $orderCouponDiscount;
	}

	/**
	 * @return string|null
	 */
	public function getOrderCouponCode(): ?string
	{
		return $this->orderCouponCode;
	}

	/**
	 * @param string|null $orderCouponCode
	 */
	public function setOrderCouponCode(?string $orderCouponCode): void
	{
		$this->orderCouponCode = $orderCouponCode;
	}

	/**
	 * @return string
	 */
	public function getOrderDiscount(): string
	{
		return $this->orderDiscount;
	}

	/**
	 * @param string $orderDiscount
	 */
	public function setOrderDiscount(string $orderDiscount): void
	{
		$this->orderDiscount = $orderDiscount;
	}

	/**
	 * @return int|null
	 */
	public function getOrderCurrency(): ?int
	{
		return $this->orderCurrency;
	}

	/**
	 * @param int|null $orderCurrency
	 */
	public function setOrderCurrency(?int $orderCurrency): void
	{
		$this->orderCurrency = $orderCurrency;
	}

	/**
	 * @return string
	 */
	public function getOrderCurrencyRate(): string
	{
		return $this->orderCurrencyRate;
	}

	/**
	 * @param string $orderCurrencyRate
	 */
	public function setOrderCurrencyRate(string $orderCurrencyRate): void
	{
		$this->orderCurrencyRate = $orderCurrencyRate;
	}

	/**
	 * @return string|null
	 */
	public function getOrderShopperGroups(): ?string
	{
		return $this->orderShopperGroups;
	}

	/**
	 * @param string|null $orderShopperGroups
	 */
	public function setOrderShopperGroups(?string $orderShopperGroups): void
	{
		$this->orderShopperGroups = $orderShopperGroups;
	}

	/**
	 * @return int|null
	 */
	public function getOrderPaymentCurrencyId(): ?int
	{
		return $this->orderPaymentCurrencyId;
	}

	/**
	 * @param int|null $orderPaymentCurrencyId
	 */
	public function setOrderPaymentCurrencyId(?int $orderPaymentCurrencyId): void
	{
		$this->orderPaymentCurrencyId = $orderPaymentCurrencyId;
	}

	/**
	 * @return string
	 */
	public function getOrderPaymentCurrencyRate(): string
	{
		return $this->orderPaymentCurrencyRate;
	}

	/**
	 * @param string $orderPaymentCurrencyRate
	 */
	public function setOrderPaymentCurrencyRate(string $orderPaymentCurrencyRate): void
	{
		$this->orderPaymentCurrencyRate = $orderPaymentCurrencyRate;
	}

	/**
	 * @return int|null
	 */
	public function getOrderPaymentMethodId(): ?int
	{
		return $this->orderPaymentMethodId;
	}

	/**
	 * @param int|null $orderPaymentMethodId
	 */
	public function setOrderPaymentMethodId(?int $orderPaymentMethodId): void
	{
		$this->orderPaymentMethodId = $orderPaymentMethodId;
	}

	/**
	 * @return int|null
	 */
	public function getOrderShipmentMethodId(): ?int
	{
		return $this->orderShipmentMethodId;
	}

	/**
	 * @param int|null $orderShipmentMethodId
	 */
	public function setOrderShipmentMethodId(?int $orderShipmentMethodId): void
	{
		$this->orderShipmentMethodId = $orderShipmentMethodId;
	}

	/**
	 * @return DateTime
	 */
	public function getOrderDeliveryDate(): DateTime
	{
		return $this->orderDeliveryDate;
	}

	/**
	 * @param DateTime $orderDeliveryDate
	 */
	public function setOrderDeliveryDate(DateTime $orderDeliveryDate): void
	{
		$this->orderDeliveryDate = $orderDeliveryDate;
	}

	/**
	 * @return string|null
	 */
	public function getOrderLanguage(): ?string
	{
		return $this->orderLanguage;
	}

	/**
	 * @param string|null $orderLanguage
	 */
	public function setOrderLanguage(?string $orderLanguage): void
	{
		$this->orderLanguage = $orderLanguage;
	}

	/**
	 * @return string
	 */
	public function getOrderIpAddress(): string
	{
		return $this->orderIpAddress;
	}

	/**
	 * @param string $orderIpAddress
	 */
	public function setOrderIpAddress(string $orderIpAddress): void
	{
		$this->orderIpAddress = $orderIpAddress;
	}

	/**
	 * @return bool
	 */
	public function isOrderSTSameAsBT(): bool
	{
		return $this->orderSTSameAsBT;
	}

	/**
	 * @param bool $orderSTSameAsBT
	 */
	public function setOrderSTSameAsBT(bool $orderSTSameAsBT): void
	{
		$this->orderSTSameAsBT = $orderSTSameAsBT;
	}

	/**
	 * @return string|null
	 */
	public function getOrderHash(): ?string
	{
		return $this->orderHash;
	}

	/**
	 * @param string|null $orderHash
	 */
	public function setOrderHash(?string $orderHash): void
	{
		$this->orderHash = $orderHash;
	}

	/**
	 * @param OrdersItems $orderItem
	 *
	 * @return Orders
	 */
	public function addOrderItem(OrdersItems $orderItem): self
	{
		$this->orderItems[] = $orderItem;

		return $this;
	}

	/**
	 * @param OrdersItems $orderItem
	 */
	public function removeOrderItem(OrdersItems $orderItem)
	{
		$this->orderItems->removeElement($orderItem);
	}

	/**
	 * @return ArrayCollection
	 */
	public function getOrderItems()
	{
		return $this->orderItems;
	}

	/**
	 * @return Orders
	 */
	public function getOrderStatus()
	{
		return $this->orderStatus;
	}

	/**
	 * @param OrdersStatus $orderStatus
	 *
	 * @return self
	 */
	public function setOrderStatus(OrdersStatus $orderStatus): self
	{
		$this->orderStatus = $orderStatus;
		return $this;
	}
}

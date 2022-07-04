<?php


namespace App\Entity\Order;

use App\Entity\BaseTrait;

use App\Entity\Vendor\Vendor;
use App\Repository\Order\OrderRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




#[ORM\Table(name: 'orders')]
#[ORM\Index(columns: ['slug'], name: 'order_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Order
{
	use BaseTrait;
	public const NUM_ITEMS = 10;

	#[ORM\Column(name: 'order_number')]
	private ?string $orderNumber = null;

	#[ORM\Column(name: 'order_customer_number')]
	private ?string $orderCustomerNumber = null;

	#[ORM\Column(name: 'order_pass')]
	private ?string $orderPass = null;

	#[ORM\Column(name: 'order_create_invoice_pass')]
	private ?string $orderCreateInvoicePass = null;

	#[ORM\Column(name: 'order_total', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
	private string $orderTotal = '0.00000';

	#[ORM\Column(name: 'order_sales_price', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
	private string $orderSalesPrice = '0.00000';

	#[ORM\Column(name: 'order_bill_tax_amount', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
	private string $orderBillTaxAmount = '0.00000';

	#[ORM\Column(name: 'order_bill_tax')]
	private ?string $orderBillTax = null;

	#[ORM\Column(name: 'order_bill_discount_amount', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
	private string $orderBillDiscountAmount = '0.00000';

	#[ORM\Column(name: 'order_discount_amount', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
	private string $orderBillDiscount = '0.00000';

	#[ORM\Column(name: 'order_subtotal')]
	private ?string $orderSubtotal = null;

	#[ORM\Column(name: 'order_tax')]
	private ?string $orderTax = null;

	#[ORM\Column(name: 'order_shipment')]
	private ?string $orderShipment = null;

	#[ORM\Column(name: 'order_shipment_tax')]
	private ?string $orderShipmentTax = null;

	#[ORM\Column(name: 'order_payment')]
	private ?string $orderPayment = null;

	#[ORM\Column(name: 'order_payment_tax')]
	private ?string $orderPaymentTax = null;

	#[ORM\Column(name: 'order_coupon_discount', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderCouponDiscount = '0.00';

	#[ORM\Column(name: 'order_coupon_code')]
	private ?string $orderCouponCode = null;

	#[ORM\Column(name: 'order_discount', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderDiscount = '0.00';

	#[ORM\Column(name: 'order_currency')]
	private ?int $orderCurrency = null;

	#[ORM\Column(name: 'order_currency_rate', type: 'decimal', nullable: false, options: ['default' => '1.000000'])]
	private string $orderCurrencyRate = '1.000000';

	#[ORM\Column(name: 'order_shopper_groups', options: ['unsigned' => true])]
	private ?int $orderShopperGroups = null;

	#[ORM\Column(name: 'order_payment_currency_id')]
	private ?int $orderPaymentCurrencyId = null;

	#[ORM\Column(name: 'order_payment_currency_rate', type: 'decimal', nullable: false, options: ['default' => '1.000000'])]
	private string $orderPaymentCurrencyRate = '1.000000';

	#[ORM\Column(name: 'order_payment_method_id')]
	private ?int $orderPaymentMethodId = null;

	#[ORM\Column(name: 'order_shipment_method_id')]
	private ?int $orderShipmentMethodId = null;

	#[ORM\Column(name: 'order_delivery_date')]
	private ?string $orderDeliveryDate;

	#[ORM\Column(name: 'order_language')]
	private ?string $orderLanguage = null;

	#[ORM\Column(name: 'order_ip_address')]
	private ?string $orderIpAddress = null;

	#[ORM\Column(name: 'order_st_same_as_bt', type: 'boolean', nullable: false)]
	private bool $orderStSameAsBt = false;

	#[ORM\Column(name: 'order_hash')]
	private ?string $orderHash = null;
	#[ORM\OneToMany(mappedBy: 'items', targetEntity: OrderItem::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
	#[Assert\Type(type: 'App\Entity\Order\Orders')]
	#[Assert\Valid]
	private ArrayCollection $orderItems;
	#[ORM\ManyToOne(targetEntity: OrderStatus::class, fetch: 'EXTRA_LAZY', inversedBy: 'orders')]
	#[ORM\JoinColumn(name: 'orderStatus_id', referencedColumnName: 'id')]
	private OrderStatus $orderStatus;
	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorOrders')]
	private Vendor $orderCreatedAt;
	public function __construct()
	{
        $t = new DateTime();
		$this->orderDeliveryDate = $t->format('Y-m-d H:i:s');
		$this->orderItems = new ArrayCollection();
	}
	public function getOrderId(): int
	{
		return $this->id;
	}
	public function getOrderNumber(): ?string
	{
		return $this->orderNumber;
	}
	public function setOrderNumber(?string $orderNumber): void
	{
		$this->orderNumber = $orderNumber;
	}
	public function getOrderCustomerNumber(): ?string
	{
		return $this->orderCustomerNumber;
	}
	public function setOrderCustomerNumber(?string $orderCustomerNumber): void
	{
		$this->orderCustomerNumber = $orderCustomerNumber;
	}
	public function getOrderPass(): ?string
	{
		return $this->orderPass;
	}
	public function setOrderPass(?string $orderPass): void
	{
		$this->orderPass = $orderPass;
	}
	public function getOrderCreateInvoicePass(): ?string
	{
		return $this->orderCreateInvoicePass;
	}
	public function setOrderCreateInvoicePass(?string $orderCreateInvoicePass): void
	{
		$this->orderCreateInvoicePass = $orderCreateInvoicePass;
	}
	public function getOrderTotal(): string
	{
		return $this->orderTotal;
	}
	public function setOrderTotal(string $orderTotal): void
	{
		$this->orderTotal = $orderTotal;
	}
	public function getOrderSalesPrice(): string
	{
		return $this->orderSalesPrice;
	}
	public function setOrderSalesPrice(string $orderSalesPrice): void
	{
		$this->orderSalesPrice = $orderSalesPrice;
	}
	public function getOrderBillTaxAmount(): string
	{
		return $this->orderBillTaxAmount;
	}
	public function setOrderBillTaxAmount(string $orderBillTaxAmount): void
	{
		$this->orderBillTaxAmount = $orderBillTaxAmount;
	}
	public function getOrderBillTax(): ?string
	{
		return $this->orderBillTax;
	}
	public function setOrderBillTax(?string $orderBillTax): void
	{
		$this->orderBillTax = $orderBillTax;
	}
	public function getOrderBillDiscountAmount(): string
	{
		return $this->orderBillDiscountAmount;
	}
	public function setOrderBillDiscountAmount(string $orderBillDiscountAmount): void
	{
		$this->orderBillDiscountAmount = $orderBillDiscountAmount;
	}
	public function getOrderBillDiscount(): string
	{
		return $this->orderBillDiscount;
	}
	public function setOrderBillDiscount(string $orderBillDiscount): void
	{
		$this->orderBillDiscount = $orderBillDiscount;
	}
	public function getOrderSubtotal(): ?string
	{
		return $this->orderSubtotal;
	}
	public function setOrderSubtotal(?string $orderSubtotal): void
	{
		$this->orderSubtotal = $orderSubtotal;
	}
	public function getOrderTax(): ?string
	{
		return $this->orderTax;
	}
	public function setOrderTax(?string $orderTax): void
	{
		$this->orderTax = $orderTax;
	}
	public function getOrderShipment(): ?string
	{
		return $this->orderShipment;
	}
	public function setOrderShipment(?string $orderShipment): void
	{
		$this->orderShipment = $orderShipment;
	}
	public function getOrderShipmentTax(): ?string
	{
		return $this->orderShipmentTax;
	}
	public function setOrderShipmentTax(?string $orderShipmentTax): void
	{
		$this->orderShipmentTax = $orderShipmentTax;
	}
	public function getOrderPayment(): ?string
	{
		return $this->orderPayment;
	}
	public function setOrderPayment(?string $orderPayment): void
	{
		$this->orderPayment = $orderPayment;
	}
	public function getOrderPaymentTax(): ?string
	{
		return $this->orderPaymentTax;
	}
	public function setOrderPaymentTax(?string $orderPaymentTax): void
	{
		$this->orderPaymentTax = $orderPaymentTax;
	}
	public function getOrderCouponDiscount(): string
	{
		return $this->orderCouponDiscount;
	}
	public function setOrderCouponDiscount(string $orderCouponDiscount): void
	{
		$this->orderCouponDiscount = $orderCouponDiscount;
	}
	public function getOrderCouponCode(): ?string
	{
		return $this->orderCouponCode;
	}
	public function setOrderCouponCode(?string $orderCouponCode): void
	{
		$this->orderCouponCode = $orderCouponCode;
	}
	public function getOrderDiscount(): string
	{
		return $this->orderDiscount;
	}
	public function setOrderDiscount(string $orderDiscount): void
	{
		$this->orderDiscount = $orderDiscount;
	}
	public function getOrderCurrency(): ?int
	{
		return $this->orderCurrency;
	}
	public function setOrderCurrency(?int $orderCurrency): void
	{
		$this->orderCurrency = $orderCurrency;
	}
	public function getOrderCurrencyRate(): string
	{
		return $this->orderCurrencyRate;
	}
	public function setOrderCurrencyRate(string $orderCurrencyRate): void
	{
		$this->orderCurrencyRate = $orderCurrencyRate;
	}
	public function getOrderShopperGroups(): ?int
	{
		return $this->orderShopperGroups;
	}
	public function setOrderShopperGroups(?int $orderShopperGroups): void
	{
		$this->orderShopperGroups = $orderShopperGroups;
	}
	public function getOrderPaymentCurrencyId(): ?int
	{
		return $this->orderPaymentCurrencyId;
	}
	public function setOrderPaymentCurrencyId(?int $orderPaymentCurrencyId): void
	{
		$this->orderPaymentCurrencyId = $orderPaymentCurrencyId;
	}
	public function getOrderPaymentCurrencyRate(): string
	{
		return $this->orderPaymentCurrencyRate;
	}
	public function setOrderPaymentCurrencyRate(string $orderPaymentCurrencyRate): void
	{
		$this->orderPaymentCurrencyRate = $orderPaymentCurrencyRate;
	}
	public function getOrderPaymentMethodId(): ?int
	{
		return $this->orderPaymentMethodId;
	}
	public function setOrderPaymentMethodId(?int $orderPaymentMethodId): void
	{
		$this->orderPaymentMethodId = $orderPaymentMethodId;
	}
	public function getOrderShipmentMethodId(): ?int
	{
		return $this->orderShipmentMethodId;
	}
	public function setOrderShipmentMethodId(?int $orderShipmentMethodId): void
	{
		$this->orderShipmentMethodId = $orderShipmentMethodId;
	}
	public function getOrderDeliveryDate(): string
	{
		return $this->orderDeliveryDate;
	}
	public function setOrderDeliveryDate(string $orderDeliveryDate): void
	{
		$this->orderDeliveryDate = $orderDeliveryDate;
	}
	public function getOrderLanguage(): ?string
	{
		return $this->orderLanguage;
	}
	public function setOrderLanguage(?string $orderLanguage): void
	{
		$this->orderLanguage = $orderLanguage;
	}
	public function getOrderIpAddress(): string
	{
		return $this->orderIpAddress;
	}
	public function setOrderIpAddress(string $orderIpAddress): void
	{
		$this->orderIpAddress = $orderIpAddress;
	}
	public function isOrderSTSameAsBT(): bool
	{
		return $this->orderStSameAsBt;
	}
	public function setOrderSTSameAsBT(bool $orderStSameAsBt): void
	{
		$this->orderStSameAsBt = $orderStSameAsBt;
	}
	public function getOrderHash(): ?string
	{
		return $this->orderHash;
	}
	public function setOrderHash(?string $orderHash): void
	{
		$this->orderHash = $orderHash;
	}
	public function addOrderItem(OrderItem $orderItem): self
	{
		$this->orderItems[] = $orderItem;

		return $this;
	}
	public function removeOrderItem(OrderItem $orderItem): void
    {
		$this->orderItems->removeElement($orderItem);
	}
	public function getOrderItems(): ArrayCollection
    {
		return $this->orderItems;
	}
	public function getOrderStatus(): OrderStatus
    {
		return $this->orderStatus;
	}
	public function setOrderStatus(OrderStatus $orderStatus): self
	{
		$this->orderStatus = $orderStatus;
		return $this;
	}
}

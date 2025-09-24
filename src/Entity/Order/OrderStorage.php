<?php

namespace App\Entity\Order;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\PriceFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\SlugTitleFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Payment\Payment;
use App\Entity\Traits\SoftDeletableTrait;
use App\Entity\Traits\TimestampableTrait;
use App\Entity\Vendor\Vendor;
use App\Enum\OrderStatus;
use App\Enum\OrderStatusEnum;
use App\Event\Order\OrderCancelledEvent;
use App\Event\Order\OrderPaidEvent;
use App\Repository\Order\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Table(name: 'order_storage')]
#[ORM\Index(columns: ['slug'], name: 'order_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class OrderStorage
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns

    use TimestampableTrait;
    use SoftDeletableTrait;
    # API Filters
    use SlugTitleFilterTrait;
    use TimestampFilterTrait;
    use RelationFilterTrait;
    use PriceFilterTrait;

	public const NUM_ITEMS = 10;

    #[ORM\Column(name: 'order_status_code', type: 'string', enumType: OrderStatusEnum::class)]
    private OrderStatusEnum $orderStatusCode = OrderStatusEnum::Draft;

	#[ORM\Column(name: 'order_number', length: 100, unique: true, nullable: true)]
	private ?string $orderNumber = null;

	#[ORM\Column(name: 'order_customer_number', nullable: true)]
	private ?string $orderCustomerNumber = null;

	#[ORM\Column(name: 'order_pass', nullable: true)]
	private ?string $orderPass = null;

	#[ORM\Column(name: 'order_create_invoice_pass', nullable: true)]
	private ?string $orderCreateInvoicePass = null;

    #[ORM\Column(name: 'order_total', type: 'decimal', precision: 10, scale: 2, nullable: false)]
    private string $orderTotal = '0.00';

    #[ORM\Column(name: 'order_sales_price', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderSalesPrice = '0.00';

	#[ORM\Column(name: 'order_bill_tax_amount', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderBillTaxAmount = '0.00';

	#[ORM\Column(name: 'order_bill_tax', nullable: true)]
	private ?string $orderBillTax = null;

	#[ORM\Column(name: 'order_bill_discount_amount', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderBillDiscountAmount = '0.00';

	#[ORM\Column(name: 'order_subtotal', nullable: true)]
	private ?string $orderSubtotal = null;

	#[ORM\Column(name: 'order_tax', nullable: true)]
	private ?string $orderTax = null;

	#[ORM\Column(name: 'order_shipment', nullable: true)]
	private ?string $orderShipment = null;

	#[ORM\Column(name: 'order_shipment_tax', nullable: true)]
	private ?string $orderShipmentTax = null;

	#[ORM\Column(name: 'order_payment', nullable: true)]
	private ?string $orderPayment = null;

	#[ORM\Column(name: 'order_payment_tax', nullable: true)]
	private ?string $orderPaymentTax = null;

	#[ORM\Column(name: 'order_coupon_discount', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderCouponDiscount = '0.00';

	#[ORM\Column(name: 'order_coupon_code', nullable: true)]
	private ?string $orderCouponCode = null;

	#[ORM\Column(name: 'order_discount', type: 'decimal', nullable: false, options: ['default' => '0.00'])]
	private string $orderDiscount = '0.00';

	#[ORM\Column(name: 'order_currency', nullable: true)]
	private ?int $orderCurrency = null;

	#[ORM\Column(name: 'order_currency_rate', type: 'decimal', nullable: false, options: ['default' => '1.000000'])]
	private string $orderCurrencyRate = '1.000000';

	#[ORM\Column(name: 'order_shopper_groups', nullable: true, options: ['unsigned' => true])]
	private ?int $orderShopperGroups = null;

	#[ORM\Column(name: 'order_payment_currency_id', nullable: true)]
	private ?int $orderPaymentCurrencyId = null;

	#[ORM\Column(name: 'order_payment_currency_rate', type: 'decimal', nullable: false, options: ['default' => '1.000000'])]
	private string $orderPaymentCurrencyRate = '1.000000';

	#[ORM\Column(name: 'order_payment_method_id', nullable: true)]
	private ?int $orderPaymentMethodId = null;

	#[ORM\Column(name: 'order_shipment_method_id', nullable: true)]
	private ?int $orderShipmentMethodId = null;

    #[ORM\Column(name: 'order_delivery_date', type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $orderDeliveryDate = null;

	#[ORM\Column(name: 'order_language', nullable: true)]
	private ?string $orderLanguage = null;

	#[ORM\Column(name: 'order_ip_address')]
	private ?string $orderIpAddress = null;

	#[ORM\Column(name: 'order_st_same_as_bt', type: 'boolean', nullable: false)]
	private bool $orderStSameAsBt = false;

	#[ORM\Column(name: 'order_hash', nullable: true)]
	private ?string $orderHash = null;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $itemsSubtotalMinor = 0;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $discountTotalMinor = 0;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $shippingTotalMinor = 0;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $taxTotalMinor = 0;

    #[ORM\Column(type: 'integer', options: ['unsigned' => true])]
    private int $grandTotalMinor = 0;


    #[ORM\Transient]
    private array $recordedEvents = [];

	#[ORM\OneToMany(mappedBy: 'orderItem', targetEntity: OrderItem::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
	#[Assert\Type(type: OrderItem::class)]
	#[Assert\Valid]
	private Collection $orderItem;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrderStatus $orderStatus = null;

	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorOrder')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Vendor $orderVendor = null;

    #[ORM\OneToMany(mappedBy: 'orderPayment', targetEntity: Payment::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $payment;

    /** @var Collection<int, OrderStatusHistory> */
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: OrderStatusHistory::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $orderStatusHistory;

    public function __construct()
	{
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();
        $this->orderDeliveryDate = $t;
        $this->cancelledAt =$t;
        $this->refundedAt =$t;
        $this->orderItem = new ArrayCollection();
        $this->payment = new ArrayCollection();
        $this->orderStatusHistory = new ArrayCollection();

	}

    #
    public function getOrderTotalAsFloat(): float
    {
        return (float)$this->orderTotal;
    }
    #
	public function getOrderId(): int
	{
		return $this->id;
	}
    #
	public function getOrderNumber(): ?string
	{
		return $this->orderNumber;
	}
	public function setOrderNumber(?string $orderNumber): void
	{
		$this->orderNumber = $orderNumber;
	}
    #
	public function getOrderCustomerNumber(): ?string
	{
		return $this->orderCustomerNumber;
	}
	public function setOrderCustomerNumber(?string $orderCustomerNumber): void
	{
		$this->orderCustomerNumber = $orderCustomerNumber;
	}
    #
	public function getOrderPass(): ?string
	{
		return $this->orderPass;
	}
	public function setOrderPass(?string $orderPass): void
	{
		$this->orderPass = $orderPass;
	}
    #
	public function getOrderCreateInvoicePass(): ?string
	{
		return $this->orderCreateInvoicePass;
	}
	public function setOrderCreateInvoicePass(?string $orderCreateInvoicePass): void
	{
		$this->orderCreateInvoicePass = $orderCreateInvoicePass;
	}
    #
	public function getOrderTotal(): string
	{
		return $this->orderTotal;
	}
	public function setOrderTotal(string $orderTotal): void
	{
		$this->orderTotal = $orderTotal;
	}
    #
	public function getOrderSalesPrice(): string
	{
		return $this->orderSalesPrice;
	}
	public function setOrderSalesPrice(string $orderSalesPrice): void
	{
		$this->orderSalesPrice = $orderSalesPrice;
	}
    #
	public function getOrderBillTaxAmount(): string
	{
		return $this->orderBillTaxAmount;
	}
	public function setOrderBillTaxAmount(string $orderBillTaxAmount): void
	{
		$this->orderBillTaxAmount = $orderBillTaxAmount;
	}
    #
	public function getOrderBillTax(): ?string
	{
		return $this->orderBillTax;
	}
	public function setOrderBillTax(?string $orderBillTax): void
	{
		$this->orderBillTax = $orderBillTax;
	}
    #
	public function getOrderBillDiscountAmount(): string
	{
		return $this->orderBillDiscountAmount;
	}
	public function setOrderBillDiscountAmount(string $orderBillDiscountAmount): void
	{
		$this->orderBillDiscountAmount = $orderBillDiscountAmount;
	}
    #
	public function getOrderSubtotal(): ?string
	{
		return $this->orderSubtotal;
	}
	public function setOrderSubtotal(?string $orderSubtotal): void
	{
		$this->orderSubtotal = $orderSubtotal;
	}
    #
	public function getOrderTax(): ?string
	{
		return $this->orderTax;
	}
	public function setOrderTax(?string $orderTax): void
	{
		$this->orderTax = $orderTax;
	}
    #
	public function getOrderShipment(): ?string
	{
		return $this->orderShipment;
	}
	public function setOrderShipment(?string $orderShipment): void
	{
		$this->orderShipment = $orderShipment;
	}
    #
	public function getOrderShipmentTax(): ?string
	{
		return $this->orderShipmentTax;
	}
	public function setOrderShipmentTax(?string $orderShipmentTax): void
	{
		$this->orderShipmentTax = $orderShipmentTax;
	}
    #
	public function getOrderPayment(): ?string
	{
		return $this->orderPayment;
	}
	public function setOrderPayment(?string $orderPayment): void
	{
		$this->orderPayment = $orderPayment;
	}
    #
	public function getOrderPaymentTax(): ?string
	{
		return $this->orderPaymentTax;
	}
	public function setOrderPaymentTax(?string $orderPaymentTax): void
	{
		$this->orderPaymentTax = $orderPaymentTax;
	}
    #
	public function getOrderCouponDiscount(): string
	{
		return $this->orderCouponDiscount;
	}
	public function setOrderCouponDiscount(string $orderCouponDiscount): void
	{
		$this->orderCouponDiscount = $orderCouponDiscount;
	}
    #
	public function getOrderCouponCode(): ?string
	{
		return $this->orderCouponCode;
	}
	public function setOrderCouponCode(?string $orderCouponCode): void
	{
		$this->orderCouponCode = $orderCouponCode;
	}
    #
	public function getOrderDiscount(): string
	{
		return $this->orderDiscount;
	}
	public function setOrderDiscount(string $orderDiscount): void
	{
		$this->orderDiscount = $orderDiscount;
	}
    #
	public function getOrderCurrency(): ?int
	{
		return $this->orderCurrency;
	}
	public function setOrderCurrency(?int $orderCurrency): void
	{
		$this->orderCurrency = $orderCurrency;
	}
    #
	public function getOrderCurrencyRate(): string
	{
		return $this->orderCurrencyRate;
	}
	public function setOrderCurrencyRate(string $orderCurrencyRate): void
	{
		$this->orderCurrencyRate = $orderCurrencyRate;
	}
    #
	public function getOrderShopperGroups(): ?int
	{
		return $this->orderShopperGroups;
	}
	public function setOrderShopperGroups(?int $orderShopperGroups): void
	{
		$this->orderShopperGroups = $orderShopperGroups;
	}
    #
	public function getOrderPaymentCurrencyId(): ?int
	{
		return $this->orderPaymentCurrencyId;
	}
	public function setOrderPaymentCurrencyId(?int $orderPaymentCurrencyId): void
	{
		$this->orderPaymentCurrencyId = $orderPaymentCurrencyId;
	}
    #
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
	public function getOrderDeliveryDate(): ?\DateTimeImmutable
	{
		return $this->orderDeliveryDate;
	}
	public function setOrderDeliveryDate(?\DateTimeImmutable $orderDeliveryDate): void
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
    # OneToMany
    public function getOrderItem(): Collection
    {
        return $this->orderItem;
    }
    public function addOrderItem(OrderItem $orderItem): self
	{
        if (!$this->orderItem->contains($orderItem)){
            $this->orderItem[] = $orderItem;

        }
		return $this;
	}
    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItem->contains($orderItem)){
            $this->orderItem->removeElement($orderItem);
        }
        return $this;
	}
    # ManyToOne
	public function getOrderStatus(): OrderStatus
    {
		return $this->orderStatus;
	}
	public function setOrderStatus(OrderStatus $orderStatus): void
	{
		$this->orderStatus = $orderStatus;
	}
    # ManyToOne
    public function getOrderVendor(): Vendor
    {
        return $this->orderVendor;
    }
    public function setOrderVendor(Vendor $orderVendor): void
    {
        $this->orderVendor = $orderVendor;
    }

    private function changeOrderStatus(OrderStatus $new, ?string $by = null): void
    {
        $old = $this->orderStatus;
        $this->orderStatus = $new;
        $this->orderStatusHistory->add(new OrderStatusHistory($this, $old, $new, $by));
    }

    public function isOrderCancellable(): bool
    {
        return in_array($this->orderStatus, [OrderStatus::NEW, OrderStatus::PAID], true);
    }

    public function isOrderRefundable(): bool
    {
        return in_array($this->orderStatus, [OrderStatus::PAID, OrderStatus::COMPLETED], true);
    }

    public function isPayable(): bool
    {
        return $this->orderStatus === OrderStatus::NEW;
    }

    public function pay(?string $by = null): void
    {
        if (!$this->isPayable()) {
            throw new \DomainException("Order cannot be paid in status {$this->orderStatus->value}");
        }
        $this->paidAt = new \DateTimeImmutable();
        $this->changeOrderStatus(OrderStatus::PAID, $by);
        $this->recordEvent(new OrderPaidEvent($this));

    }

    public function cancel(?string $by = null): void
    {
        if (!$this->isOrderCancellable()) {
            throw new \DomainException("Order cannot be cancelled in status {$this->orderStatus->value}");
        }
        $this->cancelledAt = new \DateTimeImmutable();
        $this->changeOrderStatus(OrderStatus::CANCELED, $by);
        $this->recordEvent(new OrderCancelledEvent($this));

    }

    public function refund(?string $by = null): void
    {
        if (!$this->isOrderRefundable()) {
            throw new \DomainException("Order cannot be refunded in status {$this->orderStatus->value}");
        }
        $this->refundedAt = new \DateTimeImmutable();
        $this->recordEvent(new OrderRefundedEvent($this));
        $this->changeOrderStatus(OrderStatus::REFUNDED, $by);
    }

    /** @return Collection<int, OrderStatusHistory> */
    public function getOrderStatusHistory(): Collection
    {
        return $this->orderStatusHistory;
    }

    private function recordEvent(object $event): void
    {
        $this->recordedEvents[] = $event;
    }

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    public function isShippable(): bool
    {
        return $this->status === OrderStatus::PAID;
    }

    public function isCompletable(): bool
    {
        return $this->status === OrderStatus::SHIPPED;
    }

    public function ship(?string $by = null): void
    {
        if (!$this->isShippable()) {
            throw new \DomainException("Order cannot be shipped in status {$this->status->value}");
        }
        $this->changeOrderStatus(OrderStatus::SHIPPED, $by);
        $this->recordEvent(new OrderShippedEvent($this));
    }

    public function complete(?string $by = null): void
    {
        if (!$this->isCompletable()) {
            throw new \DomainException("Order cannot be completed in status {$this->status->value}");
        }
        $this->changeOrderStatus(OrderStatus::COMPLETED, $by);
        $this->recordEvent(new OrderCompletedEvent($this));
    }

}

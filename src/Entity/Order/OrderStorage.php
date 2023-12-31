<?php

namespace App\Entity\Order;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\Vendor\Vendor;
use App\EntityInterface\Order\OrderDiscountInterface;
use App\EntityInterface\Order\OrderItemInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Order\OrderStorageInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class OrderStorage extends RootEntity implements ObjectInterface, OrderStorageInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'order')]
    private ObjectProperty $objectProperty;


    public const NUM_ITEMS = 10;

    #[ORM\Column(name: 'order_number', nullable: true)]
    private ?string $orderNumber = null;

    #[ORM\Column(name: 'order_customer_number', nullable: true)]
    private ?string $orderCustomerNumber = null;

    #[ORM\Column(name: 'order_pass', nullable: true)]
    private ?string $orderPass = null;

    #[ORM\Column(name: 'order_create_invoice_pass', nullable: true)]
    private ?string $orderCreateInvoicePass = null;

    #[ORM\Column(name: 'order_total', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
    private string $orderTotal = '0.00000';

    #[ORM\Column(name: 'order_sales_price', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
    private string $orderSalesPrice = '0.00000';

    #[ORM\Column(name: 'order_tax', nullable: true)]
    private ?string $orderTax = null;

    #[ORM\OneToMany(mappedBy: "orderDiscount", targetEntity: OrderDiscountInterface::class, cascade: ['persist'])]
    private Collection $orderDiscount;

    #[ORM\Column(name: 'order_subtotal', nullable: true)]
    private ?string $orderSubtotal = null;

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

    #[ORM\Column(name: 'order_delivery_date')]
    private ?string $orderDeliveryDate;

    #[ORM\Column(name: 'order_language', nullable: true)]
    private ?string $orderLanguage = null;

    #[ORM\Column(name: 'order_ip_address', nullable: true)]
    private ?string $orderIpAddress = null;

    #[ORM\Column(name: 'order_st_same_as_bt', type: 'boolean', nullable: false)]
    private bool $orderStSameAsBt = false;

    #[ORM\Column(name: 'order_hash', nullable: true)]
    private ?string $orderHash = null;

    #[ORM\OneToMany(mappedBy: 'orderItemStorage', targetEntity: OrderItem::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Order\OrderStorage')]
    #[Assert\Valid]
    private Collection $orderItem;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class, fetch: 'EXTRA_LAZY', inversedBy: 'orderStatusStorage')]
    private OrderStatus $orderStatus;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorOrder')]
    private Vendor $orderVendor;

    public function __construct()
    {
        parent::__construct();
        $t = new \DateTime();
        $this->orderDeliveryDate = $t->format('Y-m-d H:i:s');
        $this->orderItem = new ArrayCollection();
        $this->orderDiscount = new ArrayCollection();
        $this->orderTax = new ArrayCollection();
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
     * @return integer
     */
    public function getOrderTotal(): int
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
     * @param string|null $orderTax
     */
    public function setOrderTax(?string $orderTax): void
    {
        $this->orderTax = $orderTax;
    }

    public function setOrderDiscount($orderDiscount):void
    {
        $this->addOrderDiscount($orderDiscount);
    }

    public function addOrderDiscount($orderDiscount): void
    {
        if ($orderDiscount instanceof OrderDiscount) {
            if (!$this->orderDiscount->contains($orderDiscount)) {
                $this->orderDiscount->addOrderDiscount($orderDiscount);
            }
        } elseif ($orderDiscount instanceof Collection) {
            foreach ($orderDiscount as $discount) {
                $this->addOrderDiscount($discount);
            }
        }
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
     * @return int|null
     */
    public function getOrderShopperGroups(): ?int
    {
        return $this->orderShopperGroups;
    }

    /**
     * @param int|null $orderShopperGroups
     */
    public function setOrderShopperGroups(?int $orderShopperGroups): void
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
     * @return string|null
     */
    public function getOrderDeliveryDate(): ?string
    {
        return $this->orderDeliveryDate;
    }

    /**
     * @param string|null $orderDeliveryDate
     */
    public function setOrderDeliveryDate(?string $orderDeliveryDate): void
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
     * @return string|null
     */
    public function getOrderIpAddress(): ?string
    {
        return $this->orderIpAddress;
    }

    /**
     * @param string|null $orderIpAddress
     */
    public function setOrderIpAddress(?string $orderIpAddress): void
    {
        $this->orderIpAddress = $orderIpAddress;
    }

    /**
     * @return bool
     */
    public function isOrderStSameAsBt(): bool
    {
        return $this->orderStSameAsBt;
    }

    /**
     * @param bool $orderStSameAsBt
     */
    public function setOrderStSameAsBt(bool $orderStSameAsBt): void
    {
        $this->orderStSameAsBt = $orderStSameAsBt;
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
     * @return Collection
     */
    public function getOrderItem(): Collection
    {
        return $this->orderItem;
    }

    public function setOrderItem(OrderItemInterface $orderItem):void
    {
        $this->addOrderItem($orderItem);
    }

    public function addOrderItem($orderItem): void
    {
        if ($orderItem instanceof OrderItem) {
            if (!$this->orderItem->contains($orderItem)) {
                $this->orderItem->add($orderItem);
            }
        } elseif ($orderItem instanceof Collection) {
            foreach ($orderItem as $item) {
                $this->addOrderItem($item);
            }
        }
    }

    /**
     * @return OrderStatus
     */
    public function getOrderStatus(): OrderStatus
    {
        return $this->orderStatus;
    }

    /**
     * @param OrderStatus $orderStatus
     */
    public function setOrderStatus(OrderStatus $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return Vendor
     */
    public function getOrderVendor(): Vendor
    {
        return $this->orderVendor;
    }

    /**
     * @param Vendor $orderVendor
     */
    public function setOrderVendor(Vendor $orderVendor): void
    {
        $this->orderVendor = $orderVendor;
    }


}

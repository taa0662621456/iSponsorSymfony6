<?php
declare(strict_types=1);

namespace App\Entity\Order;

use App\Entity\Vendor\Vendors;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Collection;


/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={
 *     @ORM\Index(name="shipment_method_id", columns={"shipment_method_id"}),
 *     @ORM\Index(name="order_number", columns={"order_number"}),
 *     @ORM\Index(name="created_on", columns={"created_on"}),
 *     @ORM\Index(name="payment_method_id", columns={"payment_method_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Orders
{
    public const NUM_ITEMS = 10;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_number", type="string", nullable=true, options={"default":0})
     */
    private $orderNumber = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="customer_number", type="string", nullable=true, options={"default":0})
     */
    private $customerNumber = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_pass", type="string", nullable=true, options={"default":0})
     */
    private $orderPass = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_create_invoice_pass", type="string", nullable=true, options={"default":0})
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
     * @ORM\Column(name="order_bill_tax", type="string", nullable=true, options={"default":0})
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
     * @ORM\Column(name="order_subtotal", type="decimal", nullable=true, options={"default":0})
     */
    private $orderSubtotal = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_tax", type="decimal", nullable=true, options={"default":0})
     */
    private $orderTax = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_shipment", type="decimal", nullable=true, options={"default":0})
     */
    private $orderShipment = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_shipment_tax", type="decimal", nullable=true, options={"default":0})
     */
    private $orderShipmentTax = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_payment", type="decimal", nullable=true, options={"default":0})
     */
    private $orderPayment = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_payment_tax", type="decimal", nullable=true, options={"default":0})
     */
    private $orderPaymentTax = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="coupon_discount", type="decimal", nullable=false, options={"default"="0.00"})
     */
    private $couponDiscount = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="coupon_code", type="string", nullable=true, options={"default":0})
     */
    private $couponCode = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="order_discount", type="decimal", nullable=false, options={"default"="0.00"})
     */
    private $orderDiscount = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="order_currency", type="smallint", nullable=true, options={"default":0})
     */
    private $orderCurrency = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_status", type="string", nullable=true, options={"default":0})
     */
    private $orderStatus = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="currency_id", type="smallint", nullable=true, options={"default":0})
     */
    private $currencyId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_rate", type="decimal", nullable=false, options={"default"="1.000000"})
     */
    private $currencyRate = '1.000000';

    /**
     * @var string
     *
     * @ORM\Column(name="shopper_groups", type="string", nullable=true, options={"default"="0"})
     */
    private $shopperGroups = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="payment_currency_id", type="smallint", nullable=true, options={"default":0})
     */
    private $paymentCurrencyId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="payment_currency_rate", type="decimal", nullable=false, options={"default"="1.000000"})
     */
    private $paymentCurrencyRate = '1.000000';

    /**
     * @var integer|null
     *
     * @ORM\Column(name="payment_method_id", type="integer", nullable=true, options={"default":0})
     */
    private $PaymentMethodId = 0;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="shipment_method_id", type="integer", nullable=true, options={"default":0})
     */
    private $shipmentMethodId = '0';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="delivery_date", type="datetime", nullable=true)
     */
    private $deliveryDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="order_language", type="string", nullable=true, options={"default":0})
     */
    private $orderLanguage = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", nullable=false, options={"default"="''"})
     */
    private $ipAddress = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="STSameAsBT", type="boolean", nullable=false)
     */
    private $STSameAsBT = false;

    /**
     * @var string|null
     *
     * @ORM\Column(name="o_hash", type="string", nullable=true, options={"default":0})
     */
    private $oHash = '0';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendors", inversedBy="orders")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $createdBy;

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
     * ORM\ManyToOne(targetEntity="App\Entity\Vendors")
     * ORM\JoinColumn(name="id", referencedColumnName="id")
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
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     * ORM\ManyToOne(targetEntity="App\Entity\Vendors")
     * ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $lockedBy = 0;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order\OrdersItems", mappedBy="order", cascade={"persist"})
     **/
    private $orderItems;





























    /**
     * Orders constructor.
     *
     */
    public function __construct()
    {
        $this->deliveryDate = new \DateTime();
        $this->createdOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->lockedOn = new \DateTime();
        $this->orderItems = new ArrayCollection();

    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }

    /**
     * @param string|null $customerNumber
     */
    public function setCustomerNumber(?string $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
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
    public function getCouponDiscount(): string
    {
        return $this->couponDiscount;
    }

    /**
     * @param string $couponDiscount
     */
    public function setCouponDiscount(string $couponDiscount): void
    {
        $this->couponDiscount = $couponDiscount;
    }

    /**
     * @return string|null
     */
    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    /**
     * @param string|null $couponCode
     */
    public function setCouponCode(?string $couponCode): void
    {
        $this->couponCode = $couponCode;
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
     * @return int|null
     */
    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    /**
     * @param int|null $currencyId
     */
    public function setCurrencyId(?int $currencyId): void
    {
        $this->currencyId = $currencyId;
    }

    /**
     * @return string
     */
    public function getCurrencyRate(): string
    {
        return $this->currencyRate;
    }

    /**
     * @param string $currencyRate
     */
    public function setCurrencyRate(string $currencyRate): void
    {
        $this->currencyRate = $currencyRate;
    }

    /**
     * @return string|null
     */
    public function getShopperGroups(): ?string
    {
        return $this->shopperGroups;
    }

    /**
     * @param string|null $shopperGroups
     */
    public function setShopperGroups(?string $shopperGroups): void
    {
        $this->shopperGroups = $shopperGroups;
    }

    /**
     * @return int|null
     */
    public function getPaymentCurrencyId(): ?int
    {
        return $this->paymentCurrencyId;
    }

    /**
     * @param int|null $paymentCurrencyId
     */
    public function setPaymentCurrencyId(?int $paymentCurrencyId): void
    {
        $this->paymentCurrencyId = $paymentCurrencyId;
    }

    /**
     * @return string
     */
    public function getPaymentCurrencyRate(): string
    {
        return $this->paymentCurrencyRate;
    }

    /**
     * @param string $paymentCurrencyRate
     */
    public function setPaymentCurrencyRate(string $paymentCurrencyRate): void
    {
        $this->paymentCurrencyRate = $paymentCurrencyRate;
    }

    /**
     * @return int|null
     */
    public function getPaymentMethodId(): ?int
    {
        return $this->PaymentMethodId;
    }

    /**
     * @param int|null $PaymentMethodId
     */
    public function setPaymentMethodId(?int $PaymentMethodId): void
    {
        $this->PaymentMethodId = $PaymentMethodId;
    }

    /**
     * @return int|null
     */
    public function getShipmentMethodId(): ?int
    {
        return $this->shipmentMethodId;
    }

    /**
     * @param int|null $shipmentMethodId
     */
    public function setShipmentMethodId(?int $shipmentMethodId): void
    {
        $this->shipmentMethodId = $shipmentMethodId;
    }

    /**
     * @return \DateTime
     */
    public function getDeliveryDate(): \DateTime
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTime $deliveryDate
     */
    public function setDeliveryDate(\DateTime $deliveryDate): void
    {
        $this->deliveryDate = $deliveryDate;
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
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     */
    public function setIpAddress(string $ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return bool
     */
    public function isSTSameAsBT(): bool
    {
        return $this->STSameAsBT;
    }

    /**
     * @param bool $STSameAsBT
     */
    public function setSTSameAsBT(bool $STSameAsBT): void
    {
        $this->STSameAsBT = $STSameAsBT;
    }

    /**
     * @return string|null
     */
    public function getOHash(): ?string
    {
        return $this->oHash;
    }

    /**
     * @param string|null $oHash
     */
    public function setOHash(?string $oHash): void
    {
        $this->oHash = $oHash;
    }

    /**
     * @return Collection
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    /**
     * @param OrdersItems $orderItem
     * @return $this
     */
    public function addOrderItems(OrdersItems $orderItem): self
    {
        $this->orderItems[] = $orderItem;

        return $this;
    }

    /**
     * @param OrdersItems $orderItem
     */
    public function removeOrderItems(OrdersItems $orderItem): void
    {
        $this->orderItems->removeElement($orderItem);
    }






    /**
     * @return \DateTime
     */
    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    /**
     *
     * @ORM\PrePersist
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new DateTime();
    }

    /**
     * @ORM\PrePersist
     * @return Vendors
     */
    public function getCreatedBy(): Vendors
    {
        return $this->createdBy;
    }

    /**
     * @param Vendors
     */
    public function setCreatedBy(Vendors $createdBy = null): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedOn(): \DateTime
    {
        return $this->modifiedOn;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     */
    public function setModifiedOn(): void
    {
        $this->modifiedOn = new DateTime();
    }

    /**
     * @return Vendors
     */
    public function getModifiedBy(): Vendors
    {
        return $this->modifiedBy;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @param Vendors
     */
    public function setModifiedBy(Vendors $modifiedBy = null): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return \DateTime
     */
    public function getLockedOn(): \DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     */
    public function setLockedOn(): void
    {
        $this->lockedOn = new DateTime();
    }

    /**
     * @return Vendors
     */
    public function getLockedBy(): Vendors
    {
        return $this->lockedBy;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @param Vendors
     */
    public function setLockedBy(Vendors $lockedBy = null): void
    {
        $this->lockedBy = $lockedBy;
    }


}

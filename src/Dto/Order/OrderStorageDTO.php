<?php

namespace App\Dto\Order;

use ApiPlatform\Metadata\ApiResource;
use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\Vendor\Vendor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(mercure: true)]
final class OrderStorageDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    public const NUM_ITEMS = 10;

    private ?string $orderNumber = null;

    private ?string $orderCustomerNumber = null;

    private ?string $orderPass = null;

    private ?string $orderCreateInvoicePass = null;

    private string $orderTotal = '0.00000';

    private string $orderSalesPrice = '0.00000';

    private string $orderBillTaxAmount = '0.00000';

    private ?string $orderBillTax = null;

    private string $orderBillDiscountAmount = '0.00000';

    private string $orderBillDiscount = '0.00000';

    private ?string $orderSubtotal = null;

    private ?string $orderTax = null;

    private ?string $orderShipment = null;

    private ?string $orderShipmentTax = null;

    private ?string $orderPayment = null;

    private ?string $orderPaymentTax = null;

    private string $orderCouponDiscount = '0.00';

    private ?string $orderCouponCode = null;

    private string $orderDiscount = '0.00';

    private ?int $orderCurrency = null;

    private string $orderCurrencyRate = '1.000000';

    private ?int $orderShopperGroups = null;

    private ?int $orderPaymentCurrencyId = null;

    private string $orderPaymentCurrencyRate = '1.000000';

    private ?int $orderPaymentMethodId = null;

    private ?int $orderShipmentMethodId = null;

    private ?string $orderDeliveryDate;

    private ?string $orderLanguage = null;

    private ?string $orderIpAddress = null;

    private bool $orderStSameAsBt = false;

    private ?string $orderHash = null;

    #[Assert\Type(type: 'App\Entity\Order\OrderStorage')]
    #[Assert\Valid]
    private Collection $orderItemDTO;

    private OrderStatus $orderStatusDTO;

    private Vendor $orderVendorDTO;

    public function __construct()
    {
        parent::__construct();
        $t = new \DateTime();

        $this->orderItem = new ArrayCollection();
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

    // OneToMany
    public function getOrderItem(): Collection
    {
        return $this->orderItem;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItem->contains($orderItem)) {
            $this->orderItem[] = $orderItem;
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItem->contains($orderItem)) {
            $this->orderItem->removeElement($orderItem);
        }

        return $this;
    }

    // ManyToOne
    public function getOrderStatus(): OrderStatus
    {
        return $this->orderStatus;
    }

    public function setOrderStatus(OrderStatus $orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    // ManyToOne
    public function getOrderVendor(): Vendor
    {
        return $this->orderVendor;
    }

    public function setOrderVendor(Vendor $orderVendor): void
    {
        $this->orderVendor = $orderVendor;
    }
}

<?php

namespace App\Entity\Order;

use App\Entity\Vendor\Vendor;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Order\OrderStorageInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class OrderStorage extends ObjectSuperEntity implements ObjectInterface, OrderStorageInterface
{
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

    #[ORM\Column(name: 'order_bill_tax_amount', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
    private string $orderBillTaxAmount = '0.00000';

    #[ORM\Column(name: 'order_bill_tax', nullable: true)]
    private ?string $orderBillTax = null;

    #[ORM\Column(name: 'order_bill_discount_amount', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
    private string $orderBillDiscountAmount = '0.00000';

    #[ORM\Column(name: 'order_discount_amount', type: 'decimal', nullable: false, options: ['default' => '0.00000'])]
    private string $orderBillDiscount = '0.00000';

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

    #[ORM\OneToMany(mappedBy: 'orderItem', targetEntity: OrderItem::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
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
    }
}

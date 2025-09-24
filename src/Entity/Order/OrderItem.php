<?php


namespace App\Entity\Order;






use App\DTO\CartSnapshot;use App\DTO\CartItem;use App\Service\Tax\TaxCalculator;use App\Enum\TaxMode;use App\ValueObject\Money;use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
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
use App\Entity\Product\Product;
use App\Entity\Vendor\Vendor;
use App\Repository\Order\OrderRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'order_item')]
#[ORM\Index(columns: ['slug'], name: 'order_item_idx')]
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
class OrderItem
{

// === Money-based fields and accessors (injected) ===
#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
private int $unitPriceMinor = 0;

#[ORM\Column(type: 'integer', nullable: true, options: ['unsigned' => true])]
private ?int $unitDiscountMinor = null;

#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
private int $rowNetMinor = 0;

#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
private int $rowTaxMinor = 0;

#[ORM\Column(type: 'integer', options: ['unsigned' => true])]
private int $rowGrossMinor = 0;

#[ORM\Column(type: 'string', length: 3, options: ['fixed' => true])]
private string $currency = 'USD';

public function setQuantity(int $qty): self
{
    if ($qty < 1) {
        throw new \InvalidArgumentException('Quantity must be >= 1');
    }
    $this->itemQuantity = $qty;
    return $this;
}

public function getUnitPrice(): Money
{
    return Money::fromMinor($this->unitPriceMinor, $this->currency);
}

public function setUnitPrice(Money $money): self
{
    $this->currency = $money->currency();
    $this->unitPriceMinor = $money->amount();
    return $this;
}

public function getUnitDiscount(): ?Money
{
    return $this->unitDiscountMinor === null ? null : Money::fromMinor($this->unitDiscountMinor, $this->currency);
}

public function setUnitDiscount(?Money $money): self
{
    $this->unitDiscountMinor = $money?->amount();
    if ($money) { $this->currency = $money->currency(); }
    return $this;
}

public function getRowNet(): Money { return Money::fromMinor($this->rowNetMinor, $this->currency); }
public function getRowTax(): Money { return Money::fromMinor($this->rowTaxMinor, $this->currency); }
public function getRowGross(): Money { return Money::fromMinor($this->rowGrossMinor, $this->currency); }

public function recalculateTotals(TaxMode $mode, TaxCalculator $tax): void
{
    $qty = (int) ($this->itemQuantity ?? 1);
    $unit = $this->unitPriceMinor;
    $unitDiscount = $this->unitDiscountMinor ?? 0;
    if ($unitDiscount > $unit) {
        $unitDiscount = $unit; // clamp
    }
    $netPerUnit = $unit - $unitDiscount;
    $rowNet = max(0, $netPerUnit * $qty);
    $this->rowNetMinor = $rowNet;

    // Build a one-line cart snapshot for tax calculator
    $snapshot = new CartSnapshot([
        new CartItem(
            sku: (string) ($this->itemSku ?? ''),
            name: (string) ($this->itemName ?? ''),
            productId: (int) ($this->itemId ?? 0),
            qty: $qty,
            unitPrice: Money::fromMinor($netPerUnit, $this->currency),
            taxClass: null,
            unitDiscount: null
        ),
    ], $mode, null, [], $this->currency);

    $taxMoney = $tax->calculate($snapshot);
    $this->rowTaxMinor = $taxMoney->amount();
    $this->rowGrossMinor = $this->rowNetMinor + $this->rowTaxMinor;
}


    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use RelationFilterTrait;
    use PriceFilterTrait;

    #[ORM\Column(name: 'item_id', nullable: true)]
    private ?int $itemId = null;

    #[ORM\Column(name: 'item_sku', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $itemSku = 1;

    #[ORM\Column(name: 'item_name', type: 'string', nullable: false, options: ['default' => ''])]
    private string $itemName = 'item_name';

    #[ORM\Column(name: 'item_quantity', type: 'integer', nullable: false, options: ['default' => 1])]
    private int $itemQuantity = 1;

    #[ORM\Column(name: 'item_price', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemPrice = null;

    #[ORM\Column(name: 'item_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemPriceWithoutTax = null;

    #[ORM\Column(name: 'item_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemTax = null;

    #[ORM\Column(name: 'item_base_price_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemBasePriceWithTax = null;

    #[ORM\Column(name: 'item_discounted_price_without_tax', type: 'decimal', precision: 7, scale: 2, nullable: true)]
    private ?int $itemDiscountedPriceWithoutTax = null;

    #[ORM\Column(name: 'item_final_price', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private string $itemFinalPrice = '0.00000';

    #[ORM\Column(name: 'item_subtotal_discount', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private string $itemSubtotalDiscount = '0.00000';

    #[ORM\Column(name: 'item_subtotal_with_tax', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '0.00000'])]
    private string $itemSubtotalWithTax = '0.00000';

    #[ORM\Column(name: 'item_order_currency', nullable: true)]
    private ?int $itemOrderCurrency = null;

    #[ORM\Column(name: 'item_attribute', nullable: true)]
    private ?string $itemAttribute = null;

    #[ORM\Column(name: 'item_hash', nullable: true)]
    private ?string $itemHash = null;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorItem')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Vendor $orderItemsVendor;

    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'orderItem')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?OrderStorage $orderItem = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productOrdered')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Product $productOrdered = null;

    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
    }
    #
    public function getItemId(): ?int
    {
        return $this->itemId;
    }
    public function setItemId(?int $itemId): void
    {
        $this->itemId = $itemId;
    }
    #
    public function getItemSku(): int
    {
     return $this->itemSku;
    }
    public function setItemSku(?int $itemSku): void
    {
     $this->itemSku = $itemSku;
    }
    #
    public function getItemName(): string
    {
     return $this->itemName;
    }
    public function setItemName(?string $itemName): void
    {
     $this->itemName = $itemName;
    }
    #
    public function getItemQuantity(): ?int
    {
     return $this->itemQuantity;
    }
    public function setItemQuantity(?int $itemQuantity): void
    {
     $this->itemQuantity = $itemQuantity;
    }
    #
    public function getItemPrice(): ?int
    {
     return $this->itemPrice;
    }
    public function setItemPrice($itemPrice): void
    {
     $this->itemPrice = $itemPrice;
    }
    #
    public function getItemPriceWithoutTax(): ?int
    {
     return $this->itemPriceWithoutTax;
    }
    public function setItemPriceWithoutTax($itemPriceWithoutTax): void
    {
     $this->itemPriceWithoutTax = $itemPriceWithoutTax;
    }
    #
    public function getItemTax(): ?int
    {
     return $this->itemTax;
    }
    public function setItemTax($itemTax): void
    {
     $this->itemTax = $itemTax;
    }
    #
    public function getItemBasePriceWithTax(): ?int
    {
     return $this->itemBasePriceWithTax;
    }
    public function setItemBasePriceWithTax($itemBasePriceWithTax): void
    {
     $this->itemBasePriceWithTax = $itemBasePriceWithTax;
    }
    #
    public function getItemDiscountedPriceWithoutTax(): ?int
    {
     return $this->itemDiscountedPriceWithoutTax;
    }
    public function setItemDiscountedPriceWithoutTax($itemDiscountedPriceWithoutTax): void
    {
     $this->itemDiscountedPriceWithoutTax = $itemDiscountedPriceWithoutTax;
    }
    #
    public function getItemFinalPrice(): string
    {
     return $this->itemFinalPrice;
    }
    public function setItemFinalPrice($itemFinalPrice): void
    {
     $this->itemFinalPrice = $itemFinalPrice;
    }
    #
    public function getItemSubtotalDiscount(): string
    {
     return $this->itemSubtotalDiscount;
    }
    public function setItemSubtotalDiscount($itemSubtotalDiscount): void
    {
     $this->itemSubtotalDiscount = $itemSubtotalDiscount;
    }
    #
    public function getItemSubtotalWithTax(): string
    {
     return $this->itemSubtotalWithTax;
    }
    public function setItemSubtotalWithTax($itemSubtotalWithTax): void
    {
     $this->itemSubtotalWithTax = $itemSubtotalWithTax;
    }
    #
    public function getItemOrderCurrency(): ?int
    {
     return $this->itemOrderCurrency;
    }
    public function setItemOrderCurrency(?int $itemOrderCurrency): void
    {
     $this->itemOrderCurrency = $itemOrderCurrency;
    }
    #
    public function getItemAttribute(): string
    {
     return $this->itemAttribute;
    }
    public function setItemAttribute(?TextType $itemAttribute): void
    {
        $this->itemAttribute = $itemAttribute;
    }
    #
    public function getItemHash(): ?string
    {
        return $this->itemHash;
    }
    public function setItemHash(?string $itemHash): void
    {
        $this->itemHash = $itemHash;
    }
    # ManyToOne
    public function getOrderItemsVendor(): Vendor
    {
        return $this->orderItemsVendor;
    }
    public function setOrderItemsVendor(Vendor $orderItemsVendor): void
    {
        $this->orderItemsVendor = $orderItemsVendor;
    }
    # ManyToOne
    public function getOrderItem(): OrderStorage
    {
        return $this->orderItem;
    }
    public function setOrderItem(OrderStorage $orderItem): void
    {
        $this->orderItem = $orderItem;
    }
    # ManyToOne
    public function getProductOrdered(): Product
    {
        return $this->productOrdered;
    }
    public function setProductOrdered(Product $productOrdered): void
    {
        $this->productOrdered = $productOrdered;
    }
}

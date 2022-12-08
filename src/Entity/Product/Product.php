<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\Order\OrderItem;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectFavourite;
use App\Interface\ProductTypeInterface;
use App\Repository\Product\ProductRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

#[ORM\Table(name: 'product')]
#[ORM\Index(columns: ['slug'], name: 'product_idx')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    use BaseTrait;
    use ObjectTrait;
    use MetaTrait;

    public const NUM_ITEMS = 10;

    #[ORM\ManyToOne(targetEntity: ProductTypeInterface::class, inversedBy: 'productTypeProduct')]
    #[Assert\Type(type: 'App\Entity\Product\ProductType')]
    #[Assert\Valid]
    private ProductType $productType;

    #[ORM\Column(name: 'product_sku', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productSku = 0;

    #[ORM\Column(name: 'product_gtin', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productGtin = 0;

    #[ORM\Column(name: 'product_mpn', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productMpn = 0;

    #[ORM\Column(name: 'product_weight', type: 'decimal', nullable: true)]
    private ?NumberType $productWeight = null;

    #[ORM\Column(name: 'product_weight_uom', type: 'integer', nullable: true)]
    private ?NumberType $productWeightUom = null;

    #[ORM\Column(name: 'product_length', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => 0])]
    private int $productLength = 0;
    #[ORM\Column(name: 'product_width', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => 0])]
    private int $productWidth = 0;

    #[ORM\Column(name: 'product_height', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => 0])]
    private int $productHeight = 0;

    #[ORM\Column(name: 'product_lwh_uom', type: 'integer', precision: 7, scale: 2, nullable: false, options: ['default' => 0])]
    private int $productLwhUom = 0;

    #[ORM\Column(name: 'product_in_stock', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productInStock = 0;

    #[ORM\Column(name: 'product_stock_handle', type: 'string', nullable: false, options: ['default' => 'product_stock_handle'])]
    private string $productStockHandle = 'product_stock_handle';

    #[ORM\Column(name: 'low_stock_notification', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $lowStockNotification = 0;

    #[ORM\Column(name: 'product_available_date', type: 'string', nullable: false, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private string $productAvailableDate;

    #[ORM\Column(name: 'product_availability', type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $productAvailability = false;

    #[ORM\Column(name: 'product_special', type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $productSpecial = false;

    #[ORM\Column(name: 'product_discontinued', type: 'boolean', nullable: false, options: ['default' => false])]
    private bool $productDiscontinued = false;

    #[ORM\Column(name: 'product_sales', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productSales = 0;

    #[ORM\Column(name: 'product_unit', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productUnit = 0;

    #[ORM\Column(name: 'product_packaging', nullable: true)]
    private ?int $productPackaging = null;

    #[ORM\Column(name: 'product_param', nullable: true)]
    private ?string $productParam = null;

    #[ORM\Column(name: 'product_category', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productCategory = 0;

    #[ORM\Column(name: 'product_hit', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productHit = 0;

    #[ORM\Column(name: 'layout', type: 'integer', nullable: false, options: ['default' => 0])]
    private ?int $layout = 0;

    #[ORM\Column(name: 'product_published', type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $productPublished = true;

    #[ORM\Column(name: 'product_country_origin', type: 'string', nullable: false, options: ['default' => 'product_country_origin'])]
    private string $productCountryOrigin = 'product_country_origin';

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectProduct')]
    private Project $productProject;

    #[ORM\OneToMany(mappedBy: 'productOrdered', targetEntity: OrderItem::class)]
    private Collection $productOrdered;

    #[ORM\OneToOne(targetEntity: ProductEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Product\ProductsEnGb')]
    #[Assert\Valid]
    private ProductEnGb $productEnGb;

    #[ORM\ManyToMany(targetEntity: ProductTag::class, inversedBy: 'productTagProduct', cascade: ['persist'])]
    #[ORM\OrderBy(['firstTitle' => 'ASC'])]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTag;

    #[ORM\OneToOne(mappedBy: 'productPrice', targetEntity: ProductPrice::class, fetch: 'EAGER', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Product\ProductsPrice')]
    #[Assert\Valid]
    private ProductPrice $productPrice;

    #[ORM\ManyToMany(targetEntity: ProductFavourite::class, mappedBy: 'productFavourite')]
    private Collection $productFavourite;

    #[ORM\OneToOne(mappedBy: 'productFeatured', targetEntity: Featured::class)]
    private Featured $productFeatured;

    #[ORM\OneToMany(mappedBy: 'productAttachmentProduct', targetEntity: ProductAttachment::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productAttachment;

    #[ORM\OneToMany(mappedBy: 'productReviewProduct', targetEntity: ProductReview::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productReview;



    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');
        #
        $this->productAttachment = new ArrayCollection();
        $this->productOrdered = new ArrayCollection();
        $this->productTag = new ArrayCollection();
        $this->productReview = new ArrayCollection();
        #
        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
    # ManyToOne
    public function getProductType(): ProductType
    {
        return $this->productType;
    }
    public function setProductType(ProductType $productType): void
    {
        $this->productType = $productType;
    }
    #
    public function getProductSku(): int
    {
        return $this->productSku;
    }
    public function setProductSku(int $productSku): void
    {
        $this->productSku = $productSku;
    }
    #
    public function getProductGtin(): ?int
    {
        return $this->productGtin;
    }
    public function setProductGtin(int $productGtin): void
    {
        $this->productGtin = $productGtin;
    }
    #
    public function getProductMpn(): ?int
    {
        return $this->productMpn;
    }
    public function setProductMpn(int $productMpn): void
    {
        $this->productMpn = $productMpn;
    }
    #
    public function getProductWeight(): ?NumberType
    {
        return $this->productWeight;
    }
    public function setProductWeight(?string $productWeight): void
    {
        $this->productWeight = $productWeight;
    }
    #
    public function getProductWeightUom(): ?NumberType
    {
        return $this->productWeightUom;
    }
    public function setProductWeightUom(?int $productWeightUom): void
    {
        $this->productWeightUom = $productWeightUom;
    }
    #
    public function getProductLength(): int
    {
        return $this->productLength;
    }
    public function setProductLength($productLength): void
    {
        $this->productLength = $productLength;
    }
    #
    public function getProductWidth(): int
    {
        return $this->productWidth;
    }
    public function setProductWidth($productWidth): void
    {
        $this->productWidth = $productWidth;
    }
    #
    public function getProductHeight(): int
    {
        return $this->productHeight;
    }
    public function setProductHeight($productHeight): void
    {
        $this->productHeight = $productHeight;
    }
    #
    public function getProductLwhUom(): ?int
    {
        return $this->productLwhUom;
    }
    public function setProductLwhUom(int $productLwhUom): void
    {
        $this->productLwhUom = $productLwhUom;
    }
    #
    public function getProductInStock(): int
    {
        return $this->productInStock;
    }
    public function setProductInStock(int $productInStock): void
    {
        $this->productInStock = $productInStock;
    }
    # OneToMany
    public function getProductOrdered(): Collection
    {
        return $this->productOrdered;
    }
    public function addProductOrder(OrderItem $productOrdered): self
    {
        if (!$this->productOrdered->contains($productOrdered)){
            $this->productOrdered[] = $productOrdered;
        }
        return $this;
    }
    public function removeProductOrder(OrderItem $productOrdered): self
    {
        if ($this->productOrdered->contains($productOrdered)){
            $this->productOrdered->removeElement($productOrdered);
        }
        return $this;
    }
    #
    public function getProductStockHandle(): string
    {
        return $this->productStockHandle;
    }
    public function setProductStockHandle(string $productStockHandle): void
    {
        $this->productStockHandle = $productStockHandle;
    }
    #
    public function getLowStockNotification(): int
    {
        return $this->lowStockNotification;
    }
    public function setLowStockNotification(int $lowStockNotification): void
    {
        $this->lowStockNotification = $lowStockNotification;
    }
    #
    public function getProductAvailableDate(): string
    {
        return $this->productAvailableDate;
    }
    public function setProductAvailableDate(): void
    {
        $t = new DateTime();
        $this->productAvailableDate = $t->format('Y-m-d H:i:s');
    }
    #
    public function getProductAvailability(): ?bool
    {
        return $this->productAvailability;
    }
    public function setProductAvailability(bool $productAvailability): void
    {
        $this->productAvailability = $productAvailability;
    }
    #
    public function isProductSpecial(): bool
    {
        return $this->productSpecial;
    }
    public function setProductSpecial(bool $productSpecial): void
    {
        $this->productSpecial = $productSpecial;
    }
    #
    public function isProductDiscontinued(): bool
    {
        return $this->productDiscontinued;
    }
    public function setProductDiscontinued(bool $productDiscontinued): void
    {
        $this->productDiscontinued = $productDiscontinued;
    }
    #
    public function getProductSales(): ?int
    {
        return $this->productSales;
    }
    public function setProductSales(int $productSales): void
    {
        $this->productSales = $productSales;
    }
    #
    public function getProductUnit(): ?int
    {
        return $this->productUnit;
    }
    public function setProductUnit(int $productUnit): void
    {
        $this->productUnit = $productUnit;
    }
    #
    public function getProductPackaging(): ?int
    {
        return $this->productPackaging;
    }
    public function setProductPackaging(int $productPackaging): void
    {
        $this->productPackaging = $productPackaging;
    }
    #
    public function getProductParam(): string
    {
        return $this->productParam;
    }
    public function setProductParam(string $productParam): void
    {
        $this->productParam = $productParam;
    }
    #
    public function getProductCategory(): ?int
    {
        return $this->productCategory;
    }
    public function setProductCategory(int $productCategory): void
    {
        $this->productCategory = $productCategory;
    }
    #
    public function getProductHit(): ?int
    {
        return $this->productHit;
    }
    public function setProductHit(int $productHit): void
    {
        $this->productHit = $productHit;
    }
    #
    public function getLayout(): ?int
    {
        return $this->layout;
    }
    public function setLayout(?int $layout): void
    {
        $this->layout = $layout;
    }
    #
    public function isProductPublished(): bool
    {
        return $this->productPublished;
    }
    public function setProductPublished(bool $productPublished): void
    {
        $this->productPublished = $productPublished;
    }
    #
    public function getProductCountryOrigin(): string
    {
        return $this->productCountryOrigin;
    }
    public function setProductCountryOrigin(string $productCountryOrigin): void
    {
        $this->productCountryOrigin = $productCountryOrigin;
    }
    # ManyToMany
    public function getProductFavourite(): Collection
    {
        return $this->productFavourite;
    }
    public function addProductFavourite(ProjectFavourite $projectFavourite): self
    {
        if (!$this->productFavourite->contains($projectFavourite)){
            $this->productFavourite[] = $projectFavourite;
        }
        return $this;
    }
    public function removeProductFavourite(ProjectFavourite $projectFavourite): self
    {
        if ($this->productFavourite->contains($projectFavourite)){
            $this->productFavourite->removeElement($projectFavourite);
        }
        return $this;
    }
    # OneToOne
    public function getProductFeatured(): Featured
    {
        return $this->productFeatured;
    }
    public function setProductFeatured(Featured $productFeatured): void
    {
        $this->productFeatured = $productFeatured;
    }
    # OneToOne
    public function getProductEnGb(): ProductEnGb
    {
        return $this->productEnGb;
    }
    public function setProductEnGb(ProductEnGb $productEnGb): void
    {
        $this->productEnGb = $productEnGb;
    }
    # ManyToMany
    public function getProductTag(): Collection
    {
        return $this->productTag;
    }
    public function addProductTag(ProductTag $productTag): void
    {
        $productTag->addProductTagProduct($this);
        $this->productTag[] = $productTag;
    }
    public function removeProductTag(ProductTag $productTag): self
    {
        if ($this->productTag->contains($productTag)) {
            $this->productTag->removeElement($productTag);
        }
        return $this;
    }
    #
    public function getProductPrice(): ProductPrice
    {
        return $this->productPrice;
    }
    public function setProductPrice($productPrice): void
    {
        $this->productPrice = $productPrice;
    }
    # OneToMany
    public function getProductAttachment(): Collection
    {
        return $this->productAttachment;
    }
    public function addProductAttachment(ProductAttachment $productAttachment): self
    {
        if (!$this->productAttachment->contains($productAttachment)) {
            $this->productAttachment[] = $productAttachment;
        }
        return $this;
    }
    public function removeProductAttachment(ProductAttachment $productAttachment): self
    {
        if ($this->productAttachment->contains($productAttachment)){
            $this->productAttachment->removeElement($productAttachment);
        }
        return $this;
    }
    # OneToMany
    public function getProductReview(): Collection
    {
        return $this->productReview;
    }
    public function addProductReview(ProductReview $productReview): self
    {
        if (!$this->productReview->contains($productReview)){
            $this->productReview[] = $productReview;
        }
        return $this;
    }
    public function removeProductReview(ProductReview $productReview): self
    {
        if ($this->productReview->contains($productReview)){
            $this->productReview->removeElement($productReview);
        }
        return $this;
    }

}

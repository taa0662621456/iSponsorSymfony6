<?php

namespace App\Entity\Product;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Entity\Featured\Featured;
use App\Entity\MetaTrait;
use App\Entity\ObjectTitleTrait;
use App\Entity\Order\OrderItem;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectFavourite;
use App\Interface\Product\ProductTypeInterface;
use App\Repository\Product\ProductRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'product')]
#[ORM\Index(columns: ['slug'], name: 'product_idx')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource(types: '')]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
class Product
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    use MetaTrait;

    public const NUM_ITEMS = 10;

    #[ORM\ManyToOne(targetEntity: ProductTypeInterface::class, inversedBy: 'productTypeProduct')]
    #[Assert\Type(type: 'App\Entity\Product\ProductType')]
    #[Assert\Valid]
    private ProductType $productType;

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
    #[Ignore]
    private ProductEnGb $productEnGb;

    #[ORM\OneToOne(targetEntity: ProductProperty::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Product\ProductProperty')]
    #[Assert\Valid]
    #[Ignore]
    private ProductProperty $productProperty;

    #[ORM\ManyToMany(targetEntity: ProductTag::class, inversedBy: 'productTagProduct', cascade: ['persist'])]
    #[ORM\OrderBy(['firstTitle' => 'ASC'])]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTag;

    #[ORM\OneToOne(mappedBy: 'productPrice', targetEntity: ProductPrice::class, fetch: 'EAGER', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Product\ProductsPrice')]
    #[Assert\Valid]
    #[Ignore]
    private ProductPrice $productPrice;

    #[ORM\OneToOne(mappedBy: 'productStorage', targetEntity: ProductStorage::class, fetch: 'EAGER', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Product\ProductStorage')]
    #[Assert\Valid]
    #[Ignore]
    private ProductStorage $productStorage;

    #[ORM\ManyToMany(targetEntity: ProductFavourite::class, mappedBy: 'productFavourite')]
    private Collection $productFavourite;

    #[ORM\OneToOne(mappedBy: 'productFeatured', targetEntity: Featured::class)]
    #[Ignore]
    private Featured $productFeatured;

    #[ORM\OneToMany(mappedBy: 'productAttachmentProduct', targetEntity: ProductAttachment::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productAttachment;

    #[ORM\OneToMany(mappedBy: 'productReviewProduct', targetEntity: ProductReview::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productReview;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string) Uuid::v4();

        $this->productAttachment = new ArrayCollection();
        $this->productOrdered = new ArrayCollection();
        $this->productTag = new ArrayCollection();
        $this->productReview = new ArrayCollection();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }

    // ManyToOne
    public function getProductType(): ProductType
    {
        return $this->productType;
    }

    public function setProductType(ProductType $productType): void
    {
        $this->productType = $productType;
    }

    // OneToMany
    public function getProductOrdered(): Collection
    {
        return $this->productOrdered;
    }

    public function addProductOrder(OrderItem $productOrdered): self
    {
        if (!$this->productOrdered->contains($productOrdered)) {
            $this->productOrdered[] = $productOrdered;
        }

        return $this;
    }

    public function removeProductOrder(OrderItem $productOrdered): self
    {
        if ($this->productOrdered->contains($productOrdered)) {
            $this->productOrdered->removeElement($productOrdered);
        }

        return $this;
    }


    public function getProductCategory(): ?int
    {
        return $this->productCategory;
    }

    public function setProductCategory(int $productCategory): void
    {
        $this->productCategory = $productCategory;
    }

    public function getProductHit(): ?int
    {
        return $this->productHit;
    }

    public function setProductHit(int $productHit): void
    {
        $this->productHit = $productHit;
    }

    public function getLayout(): ?int
    {
        return $this->layout;
    }

    public function setLayout(?int $layout): void
    {
        $this->layout = $layout;
    }

    public function isProductPublished(): bool
    {
        return $this->productPublished;
    }

    public function setProductPublished(bool $productPublished): void
    {
        $this->productPublished = $productPublished;
    }

    public function getProductCountryOrigin(): string
    {
        return $this->productCountryOrigin;
    }

    public function setProductCountryOrigin(string $productCountryOrigin): void
    {
        $this->productCountryOrigin = $productCountryOrigin;
    }

    // ManyToMany
    public function getProductFavourite(): Collection
    {
        return $this->productFavourite;
    }

    public function addProductFavourite(ProjectFavourite $projectFavourite): self
    {
        if (!$this->productFavourite->contains($projectFavourite)) {
            $this->productFavourite[] = $projectFavourite;
        }

        return $this;
    }

    public function removeProductFavourite(ProjectFavourite $projectFavourite): self
    {
        if ($this->productFavourite->contains($projectFavourite)) {
            $this->productFavourite->removeElement($projectFavourite);
        }

        return $this;
    }

    // OneToOne
    public function getProductFeatured(): Featured
    {
        return $this->productFeatured;
    }

    public function setProductFeatured(Featured $productFeatured): void
    {
        $this->productFeatured = $productFeatured;
    }

    // OneToOne
    public function getProductEnGb(): ProductEnGb
    {
        return $this->productEnGb;
    }

    public function setProductEnGb(ProductEnGb $productEnGb): void
    {
        $this->productEnGb = $productEnGb;
    }

    // OneToOne
    public function getProductProperty(): ProductProperty
    {
        return $this->productProperty;
    }

    public function setProductProperty(ProductProperty $productProperty): void
    {
        $this->productProperty = $productProperty;
    }

    // OneToOne
    public function getProductStorage(): ProductStorage
    {
        return $this->productStorage;
    }

    public function setProductStorage(ProductStorage $productStorage): void
    {
        $this->productStorage = $productStorage;
    }

    // ManyToMany
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

    public function getProductPrice(): ProductPrice
    {
        return $this->productPrice;
    }

    public function setProductPrice($productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    // OneToMany
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
        if ($this->productAttachment->contains($productAttachment)) {
            $this->productAttachment->removeElement($productAttachment);
        }

        return $this;
    }

    // OneToMany
    public function getProductReview(): Collection
    {
        return $this->productReview;
    }

    public function addProductReview(ProductReview $productReview): self
    {
        if (!$this->productReview->contains($productReview)) {
            $this->productReview[] = $productReview;
        }

        return $this;
    }

    public function removeProductReview(ProductReview $productReview): self
    {
        if ($this->productReview->contains($productReview)) {
            $this->productReview->removeElement($productReview);
        }

        return $this;
    }
}

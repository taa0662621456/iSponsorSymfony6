<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\Order\OrderItem;
use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Product\ProductInterface;
use Symfony\Component\Serializer\Annotation\Ignore;
use App\EntityInterface\Product\ProductTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Product extends RootEntity implements ObjectInterface, ProductInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


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

    #[ORM\OneToMany(mappedBy: 'orderItemOrdered', targetEntity: OrderItem::class)]
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

    #[ORM\ManyToMany(targetEntity: ProductTag::class, inversedBy: 'productTag', cascade: ['persist'])]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTag;

    #[ORM\OneToOne(mappedBy: 'productPrice', targetEntity: ProductPrice::class, fetch: 'EAGER', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Product\ProductsPrice')]
    #[Assert\Valid]
    #[Ignore]
    private ProductPrice $productPrice;

    #[ORM\OneToOne(mappedBy: 'product', targetEntity: ProductStorage::class, fetch: 'EAGER', orphanRemoval: true)]
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
        parent::__construct();
        $this->productAttachment = new ArrayCollection();
        $this->productOrdered = new ArrayCollection();
        $this->productTag = new ArrayCollection();
        $this->productReview = new ArrayCollection();
    }

    public function getProductType(): ProductType
    {
        return $this->productType;
    }

    public function setProductType(ProductType $productType): void
    {
        $this->productType = $productType;
    }

    public function getProductCategory(): int
    {
        return $this->productCategory;
    }

    public function setProductCategory(int $productCategory): void
    {
        $this->productCategory = $productCategory;
    }

    public function getProductHit(): int
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

    public function getProductProject(): Project
    {
        return $this->productProject;
    }

    public function setProductProject(Project $productProject): void
    {
        $this->productProject = $productProject;
    }

    public function getProductOrdered(): Collection
    {
        return $this->productOrdered;
    }

    public function setProductOrdered(Collection $productOrdered): void
    {
        $this->productOrdered = $productOrdered;
    }

    public function getProductEnGb(): ProductEnGb
    {
        return $this->productEnGb;
    }

    public function setProductEnGb(ProductEnGb $productEnGb): void
    {
        $this->productEnGb = $productEnGb;
    }

    public function getProductProperty(): ProductProperty
    {
        return $this->productProperty;
    }

    public function setProductProperty(ProductProperty $productProperty): void
    {
        $this->productProperty = $productProperty;
    }

    public function getProductTag(): Collection
    {
        return $this->productTag;
    }

    public function setProductTag(Collection $productTag): void
    {
        $this->productTag = $productTag;
    }

    public function getProductPrice(): ProductPrice
    {
        return $this->productPrice;
    }

    public function setProductPrice(ProductPrice $productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    public function getProductStorage(): ProductStorage
    {
        return $this->productStorage;
    }

    public function setProductStorage(ProductStorage $productStorage): void
    {
        $this->productStorage = $productStorage;
    }

    public function getProductFavourite(): Collection
    {
        return $this->productFavourite;
    }

    public function setProductFavourite(Collection $productFavourite): void
    {
        $this->productFavourite = $productFavourite;
    }

    public function getProductFeatured(): Featured
    {
        return $this->productFeatured;
    }

    public function setProductFeatured(Featured $productFeatured): void
    {
        $this->productFeatured = $productFeatured;
    }

    public function getProductAttachment(): Collection
    {
        return $this->productAttachment;
    }

    public function setProductAttachment(Collection $productAttachment): void
    {
        $this->productAttachment = $productAttachment;
    }

    public function getProductReview(): Collection
    {
        return $this->productReview;
    }

    public function setProductReview(Collection $productReview): void
    {
        $this->productReview = $productReview;
    }
}

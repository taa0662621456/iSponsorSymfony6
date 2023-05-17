<?php

namespace App\Dto\Product;

use App\Dto\Abstraction\ObjectDTO;
use App\Entity\Product\ProductAttachment;
use App\Entity\Product\ProductEnGb;
use App\Entity\Product\ProductPrice;
use App\Entity\Product\ProductProperty;
use App\Entity\Product\ProductReview;
use App\Entity\Product\ProductStorage;
use App\Entity\Product\ProductTag;
use App\Entity\Product\ProductType;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\Featured\Featured;
use App\Entity\Order\OrderItem;
use App\Entity\Project\Project;
use App\Entity\Project\ProjectFavourite;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

final class ProductDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    public const NUM_ITEMS = 10;

    #[Assert\Type(type: 'App\Entity\Product\ProductType')]
    #[Assert\Valid]
    private ProductType $productTypeDTO;

    private int $productCategory = 0;

    private int $productHit = 0;

    private ?int $layout = 0;

    private bool $productPublished = true;

    private string $productCountryOrigin = 'product_country_origin';

    private Project $productProjectDTO;

    private Collection $productOrderedDTO;

    #[Assert\Type(type: 'App\Entity\Product\ProductsEnGb')]
    #[Assert\Valid]
    #[Ignore]
    private ProductEnGb $productEnGbDTO;

    #[Assert\Type(type: 'App\Entity\Product\ProductProperty')]
    #[Assert\Valid]
    #[Ignore]
    private ProductProperty $productPropertyDTO;

    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTagDTO;

    #[Assert\Type(type: 'App\Entity\Product\ProductsPrice')]
    #[Assert\Valid]
    #[Ignore]
    private ProductPrice $productPriceDTO;

    #[Assert\Type(type: 'App\Entity\Product\ProductStorage')]
    #[Assert\Valid]
    #[Ignore]
    private ProductStorage $productStorageDTO;

    private Collection $productFavouriteDTO;

    #[Ignore]
    private Featured $productFeaturedDTO;

    private Collection $productAttachmentDTO;

    private Collection $productReviewDTO;

    public function __construct()
    {
        parent::__construct();
        $this->productAttachment = new ArrayCollection();
        $this->productOrdered = new ArrayCollection();
        $this->productTag = new ArrayCollection();
        $this->productReview = new ArrayCollection();
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

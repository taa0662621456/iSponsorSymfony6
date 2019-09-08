<?php
declare(strict_types=1);

namespace App\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Order\OrdersItems;
use App\Entity\Vendor\Vendors;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Products
 *
 * @ORM\Table(name="products")
 *     indexes={
 *     ORM\Index(name="product_in_stock", columns={"product_in_stock"}),
 *     ORM\Index(name="ordering", columns={"ordering"}),
 *     ORM\Index(name="product_special", columns={"product_special"}),
 *     ORM\Index(name="created_on", columns={"created_on"}),
 *     ORM\Index(name="product_discontinued", columns={"product_discontinued"}),
 *     ORM\Index(name="published", columns={"published"}),
 *     ORM\Index(name="modified_on", columns={"modified_on"}),
 *     ORM\Index(name="product_parent_id", columns={"product_parent_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Products
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="product_parent_id", type="integer", nullable=false)
     */
    private $productParentId = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_sku", type="integer", nullable=true, options={"default":0})
     */
    private $productSku = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_gtin", type="integer", nullable=true, options={"default":0})
     */
    private $productGtin = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_mpn", type="integer", nullable=true, options={"default":0})
     */
    private $productMpn = 0;

    /**
     * @var NumberType|null
     *
     * @ORM\Column(name="product_weight", type="decimal", nullable=true, options={"default":0})
     */
    private $productWeight = 0;

    /**
     * @var NumberType|null
     *
     * @ORM\Column(name="product_weight_uom", type="string", nullable=true, options={"default":0})
     */
    private $productWeightUom = 0;

    /**
     *
     *
     * @ORM\Column(name="product_length", type="decimal", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productLength = 0;

    /**
     *
     * @ORM\Column(name="product_width", type="decimal", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productWidth = 0;

    /**
     *
     * @ORM\Column(name="product_height", type="decimal", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productHeight = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="product_lwh_uom", type="integer", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productLwhUom = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="product_in_stock", type="integer", nullable=false, options={"default":0})
     */
    private $productInStock = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order\OrdersItems", mappedBy="productId")
     */
    private $productOrdered;

    /**
     * @var string
     *
     * @ORM\Column(name="product_stock_handle", type="string", nullable=false, options={"default"="product_stock_handle"})
     */
    private $productStockHandle = 'product_stock_handle';

    /**
     * @var int
     *
     * @ORM\Column(name="low_stock_notification", type="integer", nullable=false)
     */
    private $lowStockNotification = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="product_available_date", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $productAvailableDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="product_availability", type="boolean", nullable=true)
     */
    private $productAvailability = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="product_special", type="boolean", nullable=false)
     */
    private $productSpecial = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="product_discontinued", type="boolean", nullable=false)
     */
    private $productDiscontinued = false;

    /**
     * @var int
     *
     * @ORM\Column(name="product_sales", type="integer", nullable=false)
     */
    private $productSales = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="product_unit", type="string", nullable=true, options={"default":0})
     */
    private $productUnit = 0;

    /**
     * @var NumberType|null
     *
     * @ORM\Column(name="product_packaging", type="integer", nullable=true, options={"default":0})
     */
    private $productPackaging = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="product_params", type="string", nullable=false, options={"default"="product_params"})
     */
    private $productParams = 'product_params';

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_canon_category_id", type="integer", nullable=true, options={"default":0})
     */
    private $productCanonCategoryId = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="hits", type="integer", nullable=true, options={"default":0})
     */
    private $hits = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="int_notes", type="text", nullable=true, options={"default":0})
     */
    private $intNotes = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_robot", type="string", nullable=true, options={"default"="meta_robot"})
     */
    private $metaRobot = 'meta_robot';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_author", type="string", nullable=true, options={"default"="meta_author"})
     */
    private $metaAuthor = 'meta_author';

    /**
     * @var int|null
     *
     * @ORM\Column(name="layout", type="integer", nullable=true, options={"default":0})
     */
    private $layout = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", nullable=false)
     */
    private $published = false;
	
	/**
	* @var string
	* @ORM\Column(name="country_origin", type="string", nullable=false, options={"default"=""})
	*/
	private $coutryOrigin = "";

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false)
     */
    private $ordering = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;

    /**
     *
     * @Assert\Type(type="App\Entity\Product\ProductsEnGb")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="App\Entity\Product\ProductsEnGb", cascade={"persist", "remove"}, mappedBy="product", orphanRemoval=true, fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     */
    private $productEnGb;

    /**
     * @var ProductsTags[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Product\ProductsTags", cascade={"persist"})
     * @ORM\JoinTable(name="product_tags")
     * @ORM\OrderBy({"name": "ASC"})
     * @Assert\Count(max="4", maxMessage="products.too_many_tags")
     */
    private $tags;

    /**
     * @Assert\Type(type="App\Entity\Product\ProductsPrice")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="App\Entity\Product\ProductsPrice", cascade={"persist", "remove"}, mappedBy="products", orphanRemoval=true, fetch="EAGER")
     */
    private $productPrice;

    /**
     * @ORM\OneToMany(targetEntity="ProductsFavourites", mappedBy="product")
     **/
    private $favourites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product\ProductsAttachments", mappedBy="product")
     */
    private $attachments;











    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->createdOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->lockedOn = new \DateTime();
        $this->productAvailableDate = new \DateTime();
        $this->attachments = new ArrayCollection();
        $this->productOrdered = new ArrayCollection();
        $this->tags = new ArrayCollection();

    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return int
     */
    public function getProductParentId(): int
    {
        return $this->productParentId;
    }

    /**
     * @param int $productParentId
     */
    public function setProductParentId(int $productParentId): void
    {
        $this->productParentId = $productParentId;
    }

    /**
     * @return int|null
     */
    public function getProductSku(): int
    {
        return $this->productSku;
    }

    /**
     * @param int|null $productSku
     */
    public function setProductSku(?int $productSku): void
    {
        $this->productSku = $productSku;
    }

    /**
     * @return int|null
     */
    public function getProductGtin(): ?int
    {
        return $this->productGtin;
    }

    /**
     * @param int|null $productGtin
     */
    public function setProductGtin(?int $productGtin): void
    {
        $this->productGtin = $productGtin;
    }

    /**
     * @return int|null
     */
    public function getProductMpn(): ?int
    {
        return $this->productMpn;
    }

    /**
     * @param int|null $productMpn
     */
    public function setProductMpn(?int $productMpn): void
    {
        $this->productMpn = $productMpn;
    }

    /**
     * @return NumberType|null
     */
    public function getProductWeight(): ?string
    {
        return $this->productWeight;
    }

    /**
     * @param string|null $productWeight
     */
    public function setProductWeight(?string $productWeight): void
    {
        $this->productWeight = $productWeight;
    }

    /**
     * @return string|null
     */
    public function getProductWeightUom(): ?string
    {
        return $this->productWeightUom;
    }

    /**
     * @param string|null $productWeightUom
     */
    public function setProductWeightUom(?string $productWeightUom): void
    {
        $this->productWeightUom = $productWeightUom;
    }

    /**
     * @return mixed
     */
    public function getProductLength()
    {
        return $this->productLength;
    }

    /**
     * @param mixed $productLength
     */
    public function setProductLength($productLength): void
    {
        $this->productLength = $productLength;
    }

    /**
     * @return mixed
     */
    public function getProductWidth()
    {
        return $this->productWidth;
    }

    /**
     * @param mixed $productWidth
     */
    public function setProductWidth($productWidth): void
    {
        $this->productWidth = $productWidth;
    }

    /**
     * @return mixed
     */
    public function getProductHeight()
    {
        return $this->productHeight;
    }

    /**
     * @param mixed $productHeight
     */
    public function setProductHeight($productHeight): void
    {
        $this->productHeight = $productHeight;
    }

    /**
     * @return int|null
     */
    public function getProductLwhUom(): ?int
    {
        return $this->productLwhUom;
    }

    /**
     * @param string|null $productLwhUom
     */
    public function setProductLwhUom(?string $productLwhUom): void
    {
        $this->productLwhUom = $productLwhUom;
    }

    /**
     * @return int
     */
    public function getProductInStock(): int
    {
        return $this->productInStock;
    }

    /**
     * @param int $productInStock
     */
    public function setProductInStock(int $productInStock): void
    {
        $this->productInStock = $productInStock;
    }






    /**
     * @param OrdersItems $productOrdered
     * @return Products
     */
    public function addProductOrder(OrdersItems $productOrdered): Products
    {
        $this->productOrdered[] = $productOrdered;

        return $this;
    }

    /**
     * @param OrdersItems $productOrdered
     */
    public function removeProductOrder(OrdersItems $productOrdered): void
    {
        $this->productOrdered->removeElement($productOrdered);
    }

    /**
     * @return ArrayCollection
     */
    public function getProductOrdered(): ArrayCollection
    {
        return $this->productOrdered;
    }




    /**
     * @return string
     */
    public function getProductStockHandle(): string
    {
        return $this->productStockHandle;
    }

    /**
     * @param string $productStockHandle
     */
    public function setProductStockHandle(string $productStockHandle): void
    {
        $this->productStockHandle = $productStockHandle;
    }

    /**
     * @return int
     */
    public function getLowStockNotification(): int
    {
        return $this->lowStockNotification;
    }

    /**
     * @param int $lowStockNotification
     */
    public function setLowStockNotification(int $lowStockNotification): void
    {
        $this->lowStockNotification = $lowStockNotification;
    }

    /**
     * @return \DateTime
     */
    public function getProductAvailableDate(): \DateTime
    {
        return $this->productAvailableDate;
    }

    /**
     * @throws Exception
     */
    public function setProductAvailableDate(): void
    {
        $this->productAvailableDate = new DateTime();
    }

    /**
     * @return bool|null
     */
    public function getProductAvailability(): ?bool
    {
        return $this->productAvailability;
    }

    /**
     * @param bool|null $productAvailability
     */
    public function setProductAvailability(?bool $productAvailability): void
    {
        $this->productAvailability = $productAvailability;
    }

    /**
     * @return bool
     */
    public function isProductSpecial(): bool
    {
        return $this->productSpecial;
    }

    /**
     * @param bool $productSpecial
     */
    public function setProductSpecial(bool $productSpecial): void
    {
        $this->productSpecial = $productSpecial;
    }

    /**
     * @return bool
     */
    public function isProductDiscontinued(): bool
    {
        return $this->productDiscontinued;
    }

    /**
     * @param bool $productDiscontinued
     */
    public function setProductDiscontinued(bool $productDiscontinued): void
    {
        $this->productDiscontinued = $productDiscontinued;
    }

    /**
     * @return int|null
     */
    public function getProductSales(): int
    {
        return $this->productSales;
    }

    /**
     * @param int $productSales
     */
    public function setProductSales(int $productSales): void
    {
        $this->productSales = $productSales;
    }

    /**
     * @return string|null
     */
    public function getProductUnit(): ?string
    {
        return $this->productUnit;
    }

    /**
     * @param string|null $productUnit
     */
    public function setProductUnit(?string $productUnit): void
    {
        $this->productUnit = $productUnit;
    }

    /**
     * @return NumberType|null
     */
    public function getProductPackaging(): ?int
    {
        return $this->productPackaging;
    }

    /**
     * @param int|null $productPackaging
     */
    public function setProductPackaging(?int $productPackaging): void
    {
        $this->productPackaging = $productPackaging;
    }

    /**
     * @return string
     */
    public function getProductParams(): string
    {
        return $this->productParams;
    }

    /**
     * @param string $productParams
     */
    public function setProductParams(string $productParams): void
    {
        $this->productParams = $productParams;
    }

    /**
     * @return int|null
     */
    public function getProductCanonCategoryId(): ?int
    {
        return $this->productCanonCategoryId;
    }

    /**
     * @param int|null $productCanonCategoryId
     */
    public function setProductCanonCategoryId(?int $productCanonCategoryId): void
    {
        $this->productCanonCategoryId = $productCanonCategoryId;
    }

    /**
     * @return int|null
     */
    public function getHits(): ?int
    {
        return $this->hits;
    }

    /**
     * @param int|null $hits
     */
    public function setHits(?int $hits): void
    {
        $this->hits = $hits;
    }

    /**
     * @return string|null
     */
    public function getIntNotes(): ?string
    {
        return $this->intNotes;
    }

    /**
     * @param string|null $intNotes
     */
    public function setIntNotes(?string $intNotes): void
    {
        $this->intNotes = $intNotes;
    }

    /**
     * @return string
     */
    public function getMetaRobot(): ?string
    {
        return $this->metaRobot;
    }

    /**
     * @param string $metaRobot
     */
    public function setMetaRobot(?string $metaRobot): void
    {
        $this->metaRobot = $metaRobot;
    }

    /**
     * @return string
     */
    public function getMetaAuthor(): ?string
    {
        return $this->metaAuthor;
    }

    /**
     * @param string $metaAuthor
     */
    public function setMetaAuthor(?string $metaAuthor): void
    {
        $this->metaAuthor = $metaAuthor;
    }

    /**
     * @return int|null
     */
    public function getLayout(): ?int
    {
        return $this->layout;
    }

    /**
     * @param int|null $layout
     */
    public function setLayout(?int $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     */
    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    /**
     * @return int
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }

    /**
     * @param int $ordering
     */
    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    /**
     * @ORM\PrePersist
     * @throws Exception
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new DateTime();
    }

    /**
     * @return Vendors
     */
    public function getCreatedBy(): Vendors
    {
        return $this->createdBy;
    }

    /**
     * @ORM\PrePersist()
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
     * @throws Exception
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
     * @throws Exception
     * @param Vendors
     */
    public function setModifiedBy(Vendors $modifiedBy = null): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): \DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @ORM\PreFlush
     * @ORM\PreUpdate
     * @throws Exception
     */
    public function setLockedOn(): void
    {
        $this->lockedOn = new \DateTime();
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
     * @throws Exception
     * @param Vendors
     */
    public function setLockedBy(Vendors $lockedBy = null): void
    {
        $this->lockedBy = $lockedBy;
    }

    /**
     * @return mixed
     */
    public function getProductEnGb()
    {
        return $this->productEnGb;
    }

    /**
     * @param mixed $productEnGb
     */
    public function setProductEnGb($productEnGb): void
    {
        $this->productEnGb = $productEnGb;
    }

    /**
     * @param ProductsTags $tags
     */
    public function addTags(ProductsTags $tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }


    /**
     * @param ProductsTags $tag
     */
    public function removeTag(ProductsTags $tag): void
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return Collection|ProductsTags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @return mixed
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * @param mixed $productPrice
     */
    public function setProductPrice($productPrice): void
    {
        $this->productPrice = $productPrice;
    }

    /**
     * @param ProductsAttachments $attachments
     */
    public function addAttachments(ProductsAttachments $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (!$this->attachments->contains($attachment)) {
                $this->attachments->add($attachment);
            }
        }
    }


    /**
     * @param ProductsAttachments $attachment
     */
    public function removeAttachments(ProductsAttachments $attachment): void
    {
        $this->attachments->removeElement($attachment);
    }

    /**
     * @return Collection|ProductsAttachments[]
     */
    public function getAttachments(): Collection
    {
        return $this->attachments;
    }

}

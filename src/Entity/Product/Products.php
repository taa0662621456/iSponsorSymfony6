<?php
	declare(strict_types=1);

	namespace App\Entity\Product;

	use App\Entity\BaseTrait;
	use App\Entity\Order\OrdersItems;

	use \DateTime;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\ORM\Mapping as ORM;
	use Exception;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Validator\Constraints as Assert;


	/**
	 * @ORM\Table(name="products", indexes={
	 * @ORM\Index(name="product_slug", columns={"slug"})})
	 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductsRepository")
	 * @ORM\HasLifecycleCallbacks()
	 */
	class Products
	{
		use BaseTrait;

		public const NUM_ITEMS = 10;


		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_sku", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productSku = 0;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_gtin", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productGtin = 0;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_mpn", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productMpn = 0;

		/**
		 * @var NumberType|null
		 *
		 * @ORM\Column(name="product_weight", type="decimal", nullable=true, options={"default" : 0})
		 */
		private $productWeight = 0;

		/**
		 * @var NumberType|null
		 *
		 * @ORM\Column(name="product_weight_uom", type="string", nullable=true, options={"default" : 0})
		 */
		private $productWeightUom = 0;

		/**
		 * @ORM\Column(name="product_length", type="decimal", precision=7, scale=2, nullable=false, options={"default"
		 *                                    : 0})
		 */
		private $productLength = 0;

		/**
		 * @ORM\Column(name="product_width", type="decimal", precision=7, scale=2, nullable=false, options={"default" :
		 *                                   0})
		 */
		private $productWidth = 0;

		/**
		 * @ORM\Column(name="product_height", type="decimal", precision=7, scale=2, nullable=false, options={"default"
		 *                                    : 0})
		 */
		private $productHeight = 0;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_lwh_uom", type="integer", precision=7, scale=2, nullable=false, options={"default"
		 *                                     : 0})
		 */
		private $productLwhUom = 0;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_in_stock", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productInStock = 0;

		/**
		 * @ORM\OneToMany(targetEntity="App\Entity\Order\OrdersItems",
		 *     mappedBy="productOrdered")
		 */
		private $productOrdered;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="product_stock_handle", type="string", nullable=false,
		 *                                          options={"default"="product_stock_handle"})
		 */
		private $productStockHandle = 'product_stock_handle';

		/**
		 * @var int
		 *
		 * @ORM\Column(name="low_stock_notification", type="integer", nullable=false, options={"default" : 0})
		 */
		private $lowStockNotification = 0;

		/**
		 * @var DateTime
		 *
		 * @ORM\Column(name="product_available_date", type="datetime", nullable=false,
		 *                                            options={"default":"CURRENT_TIMESTAMP"})
		 */
		private $productAvailableDate;

		/**
		 * @var bool|false
		 *
		 * @ORM\Column(name="product_availability", type="boolean", nullable=false, options={"default":false})
		 */
		private $productAvailability = false;

		/**
		 * @var bool|false
		 *
		 * @ORM\Column(name="product_special", type="boolean", nullable=false, options={"default":false})
		 */
		private $productSpecial = false;

		/**
		 * @var bool|false
		 *
		 * @ORM\Column(name="product_discontinued", type="boolean", nullable=false, options={"default":false})
		 */
		private $productDiscontinued = false;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_sales", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productSales = 0;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="product_unit", type="string", nullable=false, options={"default" : 0})
		 */
		private $productUnit = 0;

		/**
		 * @var NumberType|null
		 *
		 * @ORM\Column(name="product_packaging", type="integer", nullable=true, options={"default" : 0})
		 */
		private $productPackaging = 0;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="product_params", type="string", nullable=false, options={"default"="product_params"})
		 */
		private $productParams = 'product_params';

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_canon_category_id", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productCanonCategoryId = 0;

		/**
		 * @var int
		 *
		 * @ORM\Column(name="product_hits", type="integer", nullable=false, options={"default" : 0})
		 */
		private $productHits = 0;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="product_notes", type="text", nullable=false, options={"default"="product_notes"})
		 */
		private $productNotes = 'product_notes';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="meta_robot", type="string", nullable=false, options={"default"="meta_robot"})
		 */
		private $metaRobot = 'meta_robot';

		/**
		 * @var string
		 *
		 * @ORM\Column(name="meta_author", type="string", nullable=false, options={"default"="meta_author"})
		 */
		private $metaAuthor = 'meta_author';

		/**
		 * @var int|null
		 *
		 * @ORM\Column(name="layout", type="integer", nullable=false, options={"default" : 0})
		 */
		private $layout = 0;

		/**
		 * @var boolean
		 *
		 * @ORM\Column(name="product_published", type="boolean", nullable=false, options={"default":true})
		 */
		private $productPublished = true;

		/**
		 * @var string
		 *
		 * @ORM\Column(name="product_country_origin", type="string", nullable=false,
		 *                                            options={"default"="product_country_origin"})
		 */
		private $productCountryOrigin = 'product_country_origin';

		/**
		 * @ORM\OneToOne(targetEntity="App\Entity\Product\ProductsEnGb",
		 *     cascade={"persist", "remove"},
		 *     orphanRemoval=true)
		 * @ORM\JoinColumn(name="productEnGb_id", referencedColumnName="id", onDelete="CASCADE")
		 * @Assert\Type(type="App\Entity\Product\ProductsEnGb")
		 * @Assert\Valid()
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
		private $productTags;

		/**
		 * @ORM\OneToOne(targetEntity="App\Entity\Product\ProductsPrice",
		 *     mappedBy="productPrice",
		 *     orphanRemoval=true,
		 *     fetch="EAGER"
		 * )
		 * @Assert\Type(type="App\Entity\Product\ProductsPrice")
		 * @Assert\Valid()
		 */
		private $productPrice;

		/**
		 * @var int
		 *
		 * @ORM\ManyToMany(targetEntity="App\Entity\Product\ProductsFavourites", mappedBy="productFavourites")
		 * @ORM\JoinTable(name="product_favourites")
		 * @ORM\OrderBy({"name": "ASC"})
		 **/
		private $productFavourites;

		/**
		 * @ORM\OneToOne(targetEntity="App\Entity\Featured", mappedBy="productFeatured")
		 **/
		private $productFeatured;

		/**
		 * @ORM\OneToMany(targetEntity="App\Entity\Product\ProductsAttachments",
		 *     mappedBy="productAttachments",
		 *     cascade={"persist", "remove"},
		 *     orphanRemoval=true,
		 *     fetch="EXTRA_LAZY"
		 * )
		 */
		private $productAttachments;


		/**
		 * Product constructor.
		 */
		public function __construct()
		{
			$this->productAvailableDate = new DateTime();
			$this->productAttachments = new ArrayCollection();
			$this->productOrdered = new ArrayCollection();
			$this->productTags = new ArrayCollection();

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
		 *
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
		 * @return DateTime
		 */
		public function getProductAvailableDate(): DateTime
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
		public function getProductHits(): ?int
		{
			return $this->productHits;
		}

		/**
		 * @param int|null $productHits
		 */
		public function setProductHits(?int $productHits): void
		{
			$this->productHits = $productHits;
		}

		/**
		 * @return string|null
		 */
		public function getProductNotes(): ?string
		{
			return $this->productNotes;
		}

		/**
		 * @param string|null $productNotes
		 */
		public function setProductNotes(?string $productNotes): void
		{
			$this->productNotes = $productNotes;
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
		 * @return boolean
		 */
		public function isProductPublished(): bool
		{
			return $this->productPublished;
		}

		/**
		 * @param bool $productPublished
		 */
		public function setProductPublished(bool $productPublished): void
		{
			$this->productPublished = $productPublished;
		}

		/**
		 * @return string
		 */
		public function getProductCountryOrigin(): string
		{
			return $this->productCountryOrigin;
		}

		/**
		 * @param string $productCountryOrigin
		 */
		public function setProductCountryOrigin(string $productCountryOrigin): void
		{
			$this->productCountryOrigin = $productCountryOrigin;
		}

		/**
		 * @return ProductsTags[]|ArrayCollection
		 */
		public function getProductTags()
		{
			return $this->productTags;
		}

		/**
		 * @param ProductsTags[]|ArrayCollection $productTags
		 */
		public function setProductTags($productTags): void
		{
			$this->productTags = $productTags;
		}

		/**
		 * @return int
		 */
		public function getProductFavourites(): int
		{
			return $this->productFavourites;
		}

		/**
		 * @param int $productFavourites
		 */
		public function setProductFavourites(int $productFavourites): void
		{
			$this->productFavourites = $productFavourites;
		}


		/**
		 * @return mixed
		 */
		public function getProductFeatured()
		{
			return $this->productFeatured;
		}

		/**
		 * @param mixed $productFeatured
		 */
		public function setProductFeatured($productFeatured): void
		{
			$this->productFeatured = $productFeatured;
		}

		/**
		 * @return mixed
		 */
		public function getProductEnGb()
		{
			return $this->productEnGb;
		}

		/**
		 * @param ProductsEnGb $productEnGb
		 */
		public function setProductEnGb(ProductsEnGb $productEnGb): void
		{
			$this->productEnGb = $productEnGb;
		}

		/**
		 * @param ProductsTags $tags
		 */
		public function addTags(ProductsTags $tags): void
		{
			foreach ($tags as $tag) {
				if (!$this->productTags->contains($tag)) {
					$this->productTags->add($tag);
				}
			}
		}


		/**
		 * @param ProductsTags $tag
		 */
		public function removeTag(ProductsTags $tag): void
		{
			$this->productTags->removeElement($tag);
		}

		/**
		 * @return Collection|ProductsTags[]
		 */
		public function getTags(): Collection
		{
			return $this->productTags;
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
		public function addProductAttachment(ProductsAttachments $attachments): void
		{
			foreach ($attachments as $attachment) {
				if (!$this->productAttachments->contains($attachment)) {
					$this->productAttachments->add($attachment);
				}
			}
		}


		/**
		 * @param ProductsAttachments $attachment
		 */
		public function removeProductAttachment(ProductsAttachments $attachment): void
		{
			$this->productAttachments->removeElement($attachment);
		}

		/**
		 * @return Collection|ProductsAttachments[]
		 */
		public function getProductAttachments(): Collection
		{
			return $this->productAttachments;
		}


	}

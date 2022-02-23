<?php


	namespace App\Entity\Product;

	use App\Entity\BaseTrait;
    use App\Entity\Featured\Featured;
    use App\Entity\Order\OrderItem;
    use App\Entity\Project\Project;
    use App\Repository\Product\ProductRepository;
    use DateTime;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\ORM\Mapping as ORM;
    use Symfony\Component\Validator\Constraints as Assert;
    use Exception;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;



	#[ORM\Table(name: 'products')]
	#[ORM\Index(columns: ['slug'], name: 'product_idx')]
	#[ORM\Entity(repositoryClass: ProductRepository::class)]
	#[ORM\HasLifecycleCallbacks]
	class Product
	{
		use BaseTrait;
		public const NUM_ITEMS = 10;
		#[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectProducts')]
		#[ORM\JoinTable(name: 'products')]
		private Project $products;

		#[ORM\Column(name: 'product_sku', type: 'integer', nullable: false, options: ['default' => 0])]
		private int $productSku = 0;

		#[ORM\Column(name: 'product_gtin', type: 'integer', nullable: false, options: ['default' => 0])]
		private int $productGtin = 0;

		#[ORM\Column(name: 'product_mpn', type: 'integer', nullable: false, options: ['default' => 0])]
		private int $productMpn = 0;

		#[ORM\Column(name: 'product_weight', type: 'decimal', nullable: true, options: ['default' => 0])]
		private ?NumberType $productWeight = null;

		#[ORM\Column(name: 'product_weight_uom', type: 'integer', nullable: true, options: ['default' => 0])]
		private ?NumberType $productWeightUom = null;
		#[ORM\Column(name: 'product_length', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default'])]
		private int $productLength = 0;
		#[ORM\Column(name: 'product_width', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default' => '
                                  '])]
		private int $productWidth = 0;
		#[ORM\Column(name: 'product_height', type: 'decimal', precision: 7, scale: 2, nullable: false, options: ['default'])]
		private int $productHeight = 0;

		#[ORM\Column(name: 'product_lwh_uom', type: 'integer', precision: 7, scale: 2, nullable: false, options: ['default'])]
		private int $productLwhUom = 0;

		#[ORM\Column(name: 'product_in_stock', type: 'integer', nullable: false, options: ['default' => 0])]
		private int $productInStock = 0;

		#[ORM\OneToMany(mappedBy: 'productOrdered', targetEntity: OrderItem::class)]
		#[ORM\JoinTable(name: 'ordersItems')]
		private ArrayCollection $productOrdered;

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

		#[ORM\Column(name: 'product_packaging', type: 'integer', nullable: true, options: ['default' => 0])]
		private int $productPackaging = 0;

		#[ORM\Column(name: 'product_params', type: 'string', nullable: false, options: ['default' => 'product_params'])]
		private string $productParams = 'product_params';

		#[ORM\Column(name: 'product_canon_category_id', type: 'integer', nullable: false, options: ['default' => 0])]
		private int $productCanonCategoryId = 0;

		#[ORM\Column(name: 'product_hits', type: 'integer', nullable: false, options: ['default' => 0])]
		private int $productHits = 0;

		#[ORM\Column(name: 'product_notes', type: 'text', nullable: false, options: ['default' => 'product_notes'])]
		private string $productNotes = 'product_notes';

		#[ORM\Column(name: 'meta_robot', type: 'string', nullable: false, options: ['default' => 'meta_robot'])]
		private string $metaRobot = 'meta_robot';

		#[ORM\Column(name: 'meta_author', type: 'string', nullable: false, options: ['default' => 'meta_author'])]
		private string $metaAuthor = 'meta_author';
		/**
		 * @var int|null
		 */
		#[ORM\Column(name: 'layout', type: 'integer', nullable: false, options: ['default' => 0])]
		private ?int $layout = 0;

		#[ORM\Column(name: 'product_published', type: 'boolean', nullable: false, options: ['default' => true])]
		private bool $productPublished = true;

		#[ORM\Column(name: 'product_country_origin', type: 'string', nullable: false, options: ['default' => 'product_country_origin'])]
		private string $productCountryOrigin = 'product_country_origin';

		#[ORM\OneToOne(targetEntity: ProductEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
		#[ORM\JoinColumn(name: 'productEnGb_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
		#[Assert\Type(type: 'App\Entity\Product\ProductsEnGb')]
		#[Assert\Valid]
		private ProductEnGb $productEnGb;

		/**
		 * @var ArrayCollection|ProductTag[]
		 */
		#[ORM\ManyToMany(targetEntity: ProductTag::class, cascade: ['persist'])]
		#[ORM\JoinTable(name: 'product_tags')]
		#[ORM\OrderBy(['name' => 'ASC'])]
		#[Assert\Count(max: 4, maxMessage: 'products.too_many_tags')]
		private ArrayCollection|array $productTags;

		#[ORM\OneToOne(mappedBy: 'productPrice', targetEntity: ProductPrice::class, fetch: 'EAGER', orphanRemoval: true)]
		#[Assert\Type(type: 'App\Entity\Product\ProductsPrice')]
		#[Assert\Valid]
		private ProductPrice $productPrice;

		#[ORM\ManyToMany(targetEntity: ProductFavourite::class, mappedBy: 'productFavourites')]
		#[ORM\JoinTable(name: 'product_favourites')]
		private int $productFavourites;

		#[ORM\OneToOne(mappedBy: 'productFeatured', targetEntity: Featured::class)]
		private Featured $productFeatured;

		#[ORM\OneToMany(mappedBy: 'productAttachments', targetEntity: ProductAttachment::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
		private ArrayCollection $productAttachments;

		public function __construct()
		{
            $t = new DateTime();
			$this->productAvailableDate = $t->format('Y-m-d H:i:s');
			$this->productAttachments = new ArrayCollection();
			$this->productOrdered = new ArrayCollection();
			$this->productTags = new ArrayCollection();

		}
		public function getProductSku(): int
		{
			return $this->productSku;
		}
		public function setProductSku(int $productSku): void
		{
			$this->productSku = $productSku;
		}
		public function getProductGtin(): ?int
		{
			return $this->productGtin;
		}
		public function setProductGtin(int $productGtin): void
		{
			$this->productGtin = $productGtin;
		}
		public function getProductMpn(): ?int
		{
			return $this->productMpn;
		}
		public function setProductMpn(int $productMpn): void
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
		public function setProductWeight(?string $productWeight): void
		{
			$this->productWeight = $productWeight;
		}
		public function getProductWeightUom(): ?NumberType
        {
			return $this->productWeightUom;
		}
		public function setProductWeightUom(?int $productWeightUom): void
		{
			$this->productWeightUom = $productWeightUom;
		}
		public function getProductLength(): int
        {
			return $this->productLength;
		}
		/**
		 * @param $productLength
		 */
		public function setProductLength($productLength): void
		{
			$this->productLength = $productLength;
		}
		public function getProductWidth(): int
        {
			return $this->productWidth;
		}
		/**
		 * @param $productWidth
		 */
		public function setProductWidth($productWidth): void
		{
			$this->productWidth = $productWidth;
		}
		public function getProductHeight(): int
        {
			return $this->productHeight;
		}
		/**
		 * @param $productHeight
		 */
		public function setProductHeight($productHeight): void
		{
			$this->productHeight = $productHeight;
		}
		public function getProductLwhUom(): ?int
		{
			return $this->productLwhUom;
		}
		public function setProductLwhUom(int $productLwhUom): void
		{
			$this->productLwhUom = $productLwhUom;
		}
		public function getProductInStock(): int
		{
			return $this->productInStock;
		}
		public function setProductInStock(int $productInStock): void
		{
			$this->productInStock = $productInStock;
		}
		public function addProductOrder(OrderItem $productOrdered): Product
		{
			$this->productOrdered[] = $productOrdered;

			return $this;
		}
		public function removeProductOrder(OrderItem $productOrdered): void
		{
			$this->productOrdered->removeElement($productOrdered);
		}
		public function getProductOrdered(): ArrayCollection
		{
			return $this->productOrdered;
		}
		public function getProductStockHandle(): string
		{
			return $this->productStockHandle;
		}
		public function setProductStockHandle(string $productStockHandle): void
		{
			$this->productStockHandle = $productStockHandle;
		}
		public function getLowStockNotification(): int
		{
			return $this->lowStockNotification;
		}
		public function setLowStockNotification(int $lowStockNotification): void
		{
			$this->lowStockNotification = $lowStockNotification;
		}
		public function getProductAvailableDate(): string
		{
			return $this->productAvailableDate;
		}
		/**
		 * @throws Exception
		 */
		public function setProductAvailableDate(): void
		{
            $t = new DateTime();
			$this->productAvailableDate = $t->format('Y-m-d H:i:s');
		}
		public function getProductAvailability(): ?bool
		{
			return $this->productAvailability;
		}
		public function setProductAvailability(bool $productAvailability): void
		{
			$this->productAvailability = $productAvailability;
		}
		public function isProductSpecial(): bool
		{
			return $this->productSpecial;
		}
		public function setProductSpecial(bool $productSpecial): void
		{
			$this->productSpecial = $productSpecial;
		}
		public function isProductDiscontinued(): bool
		{
			return $this->productDiscontinued;
		}
		public function setProductDiscontinued(bool $productDiscontinued): void
		{
			$this->productDiscontinued = $productDiscontinued;
		}
		public function getProductSales(): ?int
		{
			return $this->productSales;
		}
		public function setProductSales(int $productSales): void
		{
			$this->productSales = $productSales;
		}
		public function getProductUnit(): ?int
		{
			return $this->productUnit;
		}
		public function setProductUnit(int $productUnit): void
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
		public function setProductPackaging(int $productPackaging): void
		{
			$this->productPackaging = $productPackaging;
		}
		public function getProductParams(): string
		{
			return $this->productParams;
		}
		public function setProductParams(string $productParams): void
		{
			$this->productParams = $productParams;
		}
		public function getProductCanonCategoryId(): ?int
		{
			return $this->productCanonCategoryId;
		}
		public function setProductCanonCategoryId(int $productCanonCategoryId): void
		{
			$this->productCanonCategoryId = $productCanonCategoryId;
		}
		public function getProductHits(): ?int
		{
			return $this->productHits;
		}
		public function setProductHits(int $productHits): void
		{
			$this->productHits = $productHits;
		}
		public function getProductNotes(): ?string
		{
			return $this->productNotes;
		}
		public function setProductNotes(string $productNotes): void
		{
			$this->productNotes = $productNotes;
		}
		public function getMetaRobot(): ?string
		{
			return $this->metaRobot;
		}
		public function setMetaRobot(string $metaRobot): void
		{
			$this->metaRobot = $metaRobot;
		}
		public function getMetaAuthor(): ?string
		{
			return $this->metaAuthor;
		}
		public function setMetaAuthor(string $metaAuthor): void
		{
			$this->metaAuthor = $metaAuthor;
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
		/**
		 * @return ProductTag[]|ArrayCollection
		 */
		public function getProductTags(): ArrayCollection|array
        {
			return $this->productTags;
		}
        public function getProductFavourites(): int
        {
            return $this->productFavourites;
        }
        public function setProductFavourites(int $productFavourites): void
        {
            $this->productFavourites = $productFavourites;
        }

        /**
		 * @param ArrayCollection|ProductTag[] $productTags
		 */
		public function setProductTags(ArrayCollection|array $productTags): void
		{
			$this->productTags = $productTags;
		}


		public function getProductFeatured(): Featured
        {
			return $this->productFeatured;
		}
		/**
		 * @param $productFeatured
		 */
		public function setProductFeatured($productFeatured): void
		{
			$this->productFeatured = $productFeatured;
		}
		public function getProductEnGb(): ProductEnGb
        {
			return $this->productEnGb;
		}
		public function setProductEnGb(ProductEnGb $productEnGb): void
		{
			$this->productEnGb = $productEnGb;
		}
		public function addTags(ProductTag $tags): void
		{
			foreach ($tags as $tag) {
				if (!$this->productTags->contains($tag)) {
					$this->productTags->add($tag);
				}
			}
		}
		public function removeTag(ProductTag $tag): void
		{
			$this->productTags->removeElement($tag);
		}
		public function getTags(): ArrayCollection
		{
			return $this->productTags;
		}
		public function getProductPrice(): ProductPrice
        {
			return $this->productPrice;
		}
		/**
		 * @param $productPrice
		 */
		public function setProductPrice($productPrice): void
		{
			$this->productPrice = $productPrice;
		}
		public function addProductAttachment(ProductAttachment $attachments): void
		{
			foreach ($attachments as $attachment) {
				if (!$this->productAttachments->contains($attachment)) {
					$this->productAttachments->add($attachment);
				}
			}
		}
		public function removeProductAttachment(ProductAttachment $attachment): void
		{
			$this->productAttachments->removeElement($attachment);
		}
		public function getProductAttachments(): ArrayCollection
		{
			return $this->productAttachments;
		}
	}

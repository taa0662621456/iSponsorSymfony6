<?php
declare(strict_types=1);

namespace App\Entity\Product;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * ProductPrice
 *
 * @ORM\Table(name="product_price")
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class ProductsPrice
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false, options={"default":0})
     */
    private $productId = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="shopper_group_id", type="integer", nullable=false, options={"default":0})
     */
    private $shopperGroupId = 0;

    /**
	 * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productPrice")
	 * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $productPrice = 0;

    /**
     * @var boolean|null
     *
     * @ORM\Column(name="override", type="boolean", nullable=true, options={"default":0})
     */
    private $override = false;

    /**
     * @var 
     *
     * @ORM\Column(name="product_override_price", type="decimal", precision=7, scale=2, nullable=true, options={"default":0})
     */
    private $productOverridePrice = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_tax_id", type="integer", nullable=true, options={"default":0})
     */
    private $productTaxId = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_discount_id", type="integer", nullable=true, options={"default":0})
     */
    private $productDiscountId = 0;

    /**
     * @var int|null
     *
     * @ORM\Column(name="product_currency", type="integer", nullable=true, options={"default":0})
     */
    private $productCurrency = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="product_price_publish_up", type="datetime", nullable=false)
     */
    private $productPricePublishUp;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="product_price_publish_down", type="datetime", nullable=false)
     */
    private $productPricePublishDown;

    /**
     * @var int
     *
     * @ORM\Column(name="price_quantity_start", type="integer", nullable=false, options={"default":0})
     */
    private $priceQuantityStart = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="price_quantity_end", type="integer", nullable=false, options={"default":0})
     */
    private $priceQuantityEnd = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default":0})
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false)
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default":0})
     */
    private $modifiedBy = '0';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false)
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default":0})
     */
    private $lockedBy = 0;













    /**
     * ProductPrice constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->lockedOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->createdOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getShopperGroupId(): int
    {
        return $this->shopperGroupId;
    }

    /**
     * @param int $shopperGroupId
     */
    public function setShopperGroupId(int $shopperGroupId): void
    {
        $this->shopperGroupId = $shopperGroupId;
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
     * @return bool|null
     */
    public function getOverride(): ?bool
    {
        return $this->override;
    }

    /**
     * @param bool|null $override
     */
    public function setOverride(?bool $override): void
    {
        $this->override = $override;
    }

    /**
     * @return null
     */
    public function getProductOverridePrice()
    {
        return $this->productOverridePrice;
    }

    /**
     * @param null $productOverridePrice
     */
    public function setProductOverridePrice($productOverridePrice): void
    {
        $this->productOverridePrice = $productOverridePrice;
    }

    /**
     * @return int|null
     */
    public function getProductTaxId(): ?int
    {
        return $this->productTaxId;
    }

    /**
     * @param int|null $productTaxId
     */
    public function setProductTaxId(?int $productTaxId): void
    {
        $this->productTaxId = $productTaxId;
    }

    /**
     * @return int|null
     */
    public function getProductDiscountId(): ?int
    {
        return $this->productDiscountId;
    }

    /**
     * @param int|null $productDiscountId
     */
    public function setProductDiscountId(?int $productDiscountId): void
    {
        $this->productDiscountId = $productDiscountId;
    }

    /**
     * @return int|null
     */
    public function getProductCurrency(): ?int
    {
        return $this->productCurrency;
    }

    /**
     * @param int|null $productCurrency
     */
    public function setProductCurrency(?int $productCurrency): void
    {
        $this->productCurrency = $productCurrency;
    }

    /**
     * @return DateTime
     */
    public function getProductPricePublishUp(): DateTime
    {
        return $this->productPricePublishUp;
    }

    /**
     * @param DateTime $productPricePublishUp
     */
    public function setProductPricePublishUp(DateTime $productPricePublishUp): void
    {
        $this->productPricePublishUp = $productPricePublishUp;
    }

    /**
     * @return DateTime
     */
    public function getProductPricePublishDown(): DateTime
    {
        return $this->productPricePublishDown;
    }

    /**
     * @param DateTime $productPricePublishDown
     */
    public function setProductPricePublishDown(DateTime $productPricePublishDown): void
    {
        $this->productPricePublishDown = $productPricePublishDown;
    }

    /**
     * @return int
     */
    public function getPriceQuantityStart(): int
    {
        return $this->priceQuantityStart;
    }

    /**
     * @param int $priceQuantityStart
     */
    public function setPriceQuantityStart(int $priceQuantityStart): void
    {
        $this->priceQuantityStart = $priceQuantityStart;
    }

    /**
     * @return int
     */
    public function getPriceQuantityEnd(): int
    {
        return $this->priceQuantityEnd;
    }

    /**
     * @param int $priceQuantityEnd
     */
    public function setPriceQuantityEnd(int $priceQuantityEnd): void
    {
        $this->priceQuantityEnd = $priceQuantityEnd;
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
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTime
     */
    public function getModifiedOn(): DateTime
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
     * @return int
     */
    public function getModifiedBy(): int
    {
        return $this->modifiedBy;
    }

    /**
     * @param int $modifiedBy
     */
    public function setModifiedBy(int $modifiedBy): void
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
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
        $this->lockedOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }


}






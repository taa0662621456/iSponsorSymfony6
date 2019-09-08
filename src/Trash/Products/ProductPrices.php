<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPrices
 *
 * @ORM\Table(name="product_prices", indexes={
 *     @ORM\Index(name="product_price_publish_down", columns={"product_price_publish_down"}),
 *     @ORM\Index(name="shoppergroup_id", columns={"shoppergroup_id"}),
 *     @ORM\Index(name="price_quantity_start", columns={"price_quantity_start"}),
 *     @ORM\Index(name="product_id", columns={"product_id"}),
 *     @ORM\Index(name="product_price_publish_up", columns={"product_price_publish_up"}),
 *     @ORM\Index(name="price_quantity_end", columns={"price_quantity_end"}),
 *     @ORM\Index(name="product_price", columns={"product_price"})})
 * @ORM\Entity
 */
class ProductPrices
{
    /**
     * @var integer
     *
     * @ORM\Column(name="product_price_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productPriceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     */
    private $productId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="shopper_group_id", type="integer", nullable=false)
     */
    private $shopperGroupId = '0';

    /**
     * @var decimal|null
     *
     * @ORM\Column(name="product_price", type="decimal", nullable=true, options={"default":0})
     */
    private $productPrice = '0';

    /**
     * @var boolean|null
     *
     * @ORM\Column(name="override", type="boolean", nullable=true, options={"default":0})
     */
    private $override = '0';

    /**
     * @var decimal|null
     *
     * @ORM\Column(name="product_override_price", type="decimal", nullable=true, options={"default":0})
     */
    private $productOverridePrice = '0';

    /**
     * @var integer|null
     *
     * @ORM\Column(name="product_tax_id", type="integer", nullable=true, options={"default":0})
     */
    private $productTaxId = '0';

    /**
     * @var integer|null
     *
     * @ORM\Column(name="product_discount_id", type="integer", nullable=true, options={"default":0})
     */
    private $productDiscountId = '0';

    /**
     * @var smallint|null
     *
     * @ORM\Column(name="product_currency", type="smallint", nullable=true, options={"default":0})
     */
    private $productCurrency = '0';

    /**
     * @var datetime
     *
     * @ORM\Column(name="product_price_publish_up", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $productPricePublishUp = '\'0000-00-00 00:00:00\'';

    /**
     * @var datetime
     *
     * @ORM\Column(name="product_price_publish_down", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $productPricePublishDown = '\'0000-00-00 00:00:00\'';

    /**
     * @var integer
     *
     * @ORM\Column(name="price_quantity_start", type="integer", nullable=false)
     */
    private $priceQuantityStart = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="price_quantity_end", type="integer", nullable=false)
     */
    private $priceQuantityEnd = '0';

    /**
     * @var datetime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn = '\'0000-00-00 00:00:00\'';

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = '0';

    /**
     * @var datetime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $modifiedOn = '\'0000-00-00 00:00:00\'';

    /**
     * @var integer
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = '0';

    /**
     * @var datetime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn = '\'0000-00-00 00:00:00\'';

    /**
     * @var integer
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = '0';

    /**
     * @return int
     */
    public function getProductPriceId(): int
    {
        return $this->productPriceId;
    }

    /**
     * @param int $productPriceId
     */
    public function setProductPriceId(int $productPriceId): void
    {
        $this->productPriceId = $productPriceId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
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
     * @return decimal|null
     */
    public function getProductPrice(): ?decimal
    {
        return $this->productPrice;
    }

    /**
     * @param decimal|null $productPrice
     */
    public function setProductPrice(?decimal $productPrice): void
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
     * @return decimal|null
     */
    public function getProductOverridePrice(): ?decimal
    {
        return $this->productOverridePrice;
    }

    /**
     * @param decimal|null $productOverridePrice
     */
    public function setProductOverridePrice(?decimal $productOverridePrice): void
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
     * @return smallint|null
     */
    public function getProductCurrency(): ?smallint
    {
        return $this->productCurrency;
    }

    /**
     * @param smallint|null $productCurrency
     */
    public function setProductCurrency(?smallint $productCurrency): void
    {
        $this->productCurrency = $productCurrency;
    }

    /**
     * @return datetime
     */
    public function getProductPricePublishUp(): datetime
    {
        return $this->productPricePublishUp;
    }

    /**
     * @param datetime $productPricePublishUp
     */
    public function setProductPricePublishUp(datetime $productPricePublishUp): void
    {
        $this->productPricePublishUp = $productPricePublishUp;
    }

    /**
     * @return datetime
     */
    public function getProductPricePublishDown(): datetime
    {
        return $this->productPricePublishDown;
    }

    /**
     * @param datetime $productPricePublishDown
     */
    public function setProductPricePublishDown(datetime $productPricePublishDown): void
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
     * @return datetime
     */
    public function getCreatedOn(): datetime
    {
        return $this->createdOn;
    }

    /**
     * @param datetime $createdOn
     */
    public function setCreatedOn(datetime $createdOn): void
    {
        $this->createdOn = $createdOn;
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
     * @return datetime
     */
    public function getModifiedOn(): datetime
    {
        return $this->modifiedOn;
    }

    /**
     * @param datetime $modifiedOn
     */
    public function setModifiedOn(datetime $modifiedOn): void
    {
        $this->modifiedOn = $modifiedOn;
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
     * @return datetime
     */
    public function getLockedOn(): datetime
    {
        return $this->lockedOn;
    }

    /**
     * @param datetime $lockedOn
     */
    public function setLockedOn(datetime $lockedOn): void
    {
        $this->lockedOn = $lockedOn;
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

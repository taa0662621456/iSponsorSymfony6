<?php
declare(strict_types=1);

namespace App\Entity\Product;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;




/**
 * @ORM\Table(name="products_en_gb")
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductsEnGb
{
    /**
     * @var int
     *
<<<<<<< HEAD
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
=======
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
>>>>>>> github/master
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", nullable=false, options={"default"=""})
     */
    private $productName = 'product_name';

    /**
     * @var string
     *
     * @ORM\Column(name="product_s_desc", type="text", nullable=false, options={"default"="product_s_desc"})
     */
    private $productSDesc ='product_s_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="product_desc", type="text", nullable=false, options={"default"="product_desc"})
     */
    private $productDesc = 'product_desc';


    /**
     * @var string
     *
     * @ORM\Column(name="meta_desc", type="string", nullable=false, options={"default"=""})
     */
    private $metaDesc = 'meta_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_key", type="string", nullable=false, options={"default"=""})
     */
    private $metaKey = 'meta_key';

    /**
     * @var string
     *
     * @ORM\Column(name="custom_title", type="string", nullable=false, options={"default"="custom_title"})
     */
    private $customTitle = 'custom_title';

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $createdOn;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="created_by", type="integer", nullable=false, options={"default" : 1})
	 */
	private $createdBy = 1;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $modifiedOn;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="modified_by", type="integer", nullable=false, options={"default" : 1})
	 */
	private $modifiedBy = 1;

	/**
	 * @var DateTime
	 *
	 * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $lockedOn;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="locked_by", type="integer", nullable=false, options={"default" : 1})
	 */
	private $lockedBy = 1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productEnGb")
     * @ORM\JoinColumn(name="productsEnGb_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $productsEnGb;






    /**
     * ProjectsEnGb constructor.
     * @throws Exception
     */
    public function __construct()
    {
		$this->createdOn = new DateTime();
		$this->modifiedOn = new DateTime();
		$this->lockedOn = new DateTime();
    }

	/**
	 * @return string
	 */
	public function __toString() {

		return $this->getProductName();

	}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductSDesc(): string
    {
        return $this->productSDesc;
    }

    /**
     * @param string $productSDesc
     */
    public function setProductSDesc(string $productSDesc): void
    {
        $this->productSDesc = $productSDesc;
    }

    /**
     * @return string
     */
    public function getProductDesc(): string
    {
        return $this->productDesc;
    }

    /**
     * @param string $productDesc
     */
    public function setProductDesc(string $productDesc): void
    {
        $this->productDesc = $productDesc;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getMetaDesc(): string
    {
        return $this->metaDesc;
    }

    /**
     * @param string $metaDesc
     */
    public function setMetaDesc(string $metaDesc): void
    {
        $this->metaDesc = $metaDesc;
    }

    /**
     * @return string
     */
    public function getMetaKey(): string
    {
        return $this->metaKey;
    }

    /**
     * @param string $metaKey
     */
    public function setMetaKey(string $metaKey): void
    {
        $this->metaKey = $metaKey;
    }

    /**
     * @return string
     */
    public function getCustomTitle(): string
    {
        return $this->customTitle;
    }

    /**
     * @param string $customTitle
     */
    public function setCustomTitle(string $customTitle): void
    {
        $this->customTitle = $customTitle;
    }

	/**
	 * @param Products $productsEnGb
	 */
	public function setProductsEnGb(Products $productsEnGb): void
	{
		$this->productsEnGb = $productsEnGb;
	}

	/**
	 * @return DateTime
	 */
	public function getCreatedOn(): DateTime
	{
		return $this->createdOn;
	}

	/**
	 * @param DateTime $createdOn
	 */
	public function setCreatedOn(DateTime $createdOn): void
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
	 * @return DateTime
	 */
	public function getModifiedOn(): DateTime
	{
		return $this->modifiedOn;
	}

	/**
	 * @param DateTime $modifiedOn
	 */
	public function setModifiedOn(DateTime $modifiedOn): void
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
	 * @return DateTime
	 */
	public function getLockedOn(): DateTime
	{
		return $this->lockedOn;
	}

	/**
	 * @param DateTime $lockedOn
	 */
	public function setLockedOn(DateTime $lockedOn): void
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

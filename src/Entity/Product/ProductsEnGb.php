<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\Table(name="products_en_gb", indexes={
 * @ORM\Index(name="product_en_gb_slug", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductsEnGb
{
	use BaseTrait;

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
	private $productSDesc = 'product_s_desc';

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
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productEnGb")
     * @ORM\JoinColumn(name="productsEnGb_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $productsEnGb;




	/**
	 * @return string
	 */
	public function __toString() {

		return $this->getProductName();

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
}

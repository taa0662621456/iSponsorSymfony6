<?php
declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * ProductsEnGb
 *
 * @ORM\Table(name="products_en_gb")
 * @UniqueEntity("slug", message="This slug is already in use.")
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class ProductsEnGb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @ORM\Column(name="product_name", type="string", nullable=false, options={"default"=""})
     */
    private $productName = 'product_name';

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
     * @ORM\Column(name="custom_title", type="string", nullable=false, options={"default"=""})
     */
    private $customTitle = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", nullable=true, options={"default"=""})
     */
    private $slug = '';

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\Products", inversedBy="productEnGb")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $product;







    /**
     * ProjectsEnGb constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->createdOn = new \DateTime();
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
     * @return string|null
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProducts($product): void
    {
        $this->product = $product;
    }










}

<?php
declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\Table(name="products_en_gb", indexes={
 * @ORM\Index(name="product_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductEnGb
{
    use BaseTrait;
    use ObjectTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", nullable=false, options={"default"=""})
     */
    private string $productName = 'product_name';

    /**
     * @var string
	 *
	 * @ORM\Column(name="product_s_desc", type="text", nullable=false, options={"default"="product_s_desc"})
	 */
	private string $productSDesc = 'product_s_desc';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="product_desc", type="text", nullable=false, options={"default"="product_desc"})
	 */
    private string $productDesc = 'product_desc';

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
}

<?php


namespace App\Entity\Product;


use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

trait ProductLanguageTrait
{

    #[ORM\Column(name: 'product_name', type: 'string', nullable: false, options: ['default' => ''])]
    private string $productName = 'product_name';


    #[ORM\Column(name: 'product_s_desc', type: 'text', nullable: false, options: ['default' => 'product_s_desc'])]
    private string $productSDesc = 'product_s_desc';


    #[ORM\Column(name: 'product_desc', type: 'text', nullable: false, options: ['default' => 'product_desc'])]
    private string $productDesc = 'product_desc';

    /**
     * @return string
     */
    #[Pure]
    public function __toString() {
        return $this->getProductName();
    }

    public function getProductSDesc(): string
    {
        return $this->productSDesc;
    }

    public function setProductSDesc(string $productSDesc): void
    {
        $this->productSDesc = $productSDesc;
    }

    public function getProductDesc(): string
    {
        return $this->productDesc;
    }

    public function setProductDesc(string $productDesc): void
    {
        $this->productDesc = $productDesc;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

}

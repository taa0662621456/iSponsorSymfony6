<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="products_lang")
 * @ORM\Entity(repositoryClass="App\Repository\ProductsLangRepository")
 */
class ProductsLang
{
    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false, options={"comment"="Primary Key"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", nullable=false)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="product_s_desc", type="string", nullable=false)
     */
    private $productSDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="product_desc", type="text", nullable=false)
     */
    private $productDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="product_meta_desc", type="string", nullable=false)
     */
    private $productMetaDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="product_meta_key", type="string", nullable=false)
     */
    private $productMetaKey;

    /**
     * @var string
     *
     * @ORM\Column(name="product_slug", type="string", nullable=false)
     */
    private $productSlug;
    
    
    
    

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string productName
     * @return ProductsLang
     */
    public function setProductName(string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductSDesc(): ?string
    {
        return $this->productSDesc;
    }

    /**
     * @param string productSDesc
     * @return ProductsLang
     */
    public function setProductSDesc(string $productSDesc): self
    {
        $this->productSDesc = $productSDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductDesc(): ?string
    {
        return $this->productDesc;
    }

    /**
     * @param string productDesc
     * @return ProductsLang
     */
    public function setProductDesc(string $productDesc): self
    {
        $this->productDesc = $productDesc;
        return $this;
    }


    /**
     * @return string
     */
    public function getProductMetaDesc(): ?string
    {
        return $this->productMetaDesc;
    }

    /**
     * @param string $productMetaDesc
     * @return ProductsLang
     */
    public function setProductMetaDesc(string $productMetaDesc): self
    {
        $this->productMetaDesc = $productMetaDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductMetaKey(): ?string
    {
        return $this->productMetaKey;
    }

    /**
     * @param string $productMetaKey
     * @return ProductsLang
     */
    public function setProductMetaKey(string $productMetaKey): self
    {
        $this->productMetaKey = $productMetaKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductSlug(): string
    {
        return $this->productSlug;
    }

    /**
     * @param string $productSlug
     * @return ProductsLang
     */
    public function setProductSlug(string $productSlug): self
    {
        $this->productSlug = $productSlug;
        return $this;
    }



}
<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Interface\Product\ProductTypeInterface;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
final class ProductType extends ObjectSuperEntity implements ObjectInterface, ProductTypeInterface
{
    #[ORM\OneToMany(mappedBy: 'productType', targetEntity: Product::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productTypeProduct;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->productTypeProduct = new ArrayCollection();
    }

    // OneToMany
    public function getProductTypeProduct(): Collection
    {
        return $this->productTypeProduct;
    }

    public function addProductTypeProduct(Product $product): self
    {
        if (!$this->productTypeProduct->contains($product)) {
            $this->productTypeProduct[] = $product;
        }

        return $this;
    }

    public function removeProductTypeProduct(Product $product): self
    {
        if ($this->productTypeProduct->contains($product)) {
            $this->productTypeProduct->removeElement($product);
        }

        return $this;
    }
}

<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Product\ProductFavouriteInterface;

#[ORM\Entity]
final class ProductFavourite extends ObjectSuperEntity implements ObjectInterface, ProductFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
    private Product $productFavourite;

    public function getProductFavourite(): Product
    {
        return $this->productFavourite;
    }

    public function setProductFavourite(Product $productFavourite): void
    {
        $this->productFavourite = $productFavourite;
    }
}

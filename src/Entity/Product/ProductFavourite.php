<?php

namespace App\Entity\Product;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductFavouriteInterface;

#[ORM\Entity]
class ProductFavourite extends RootEntity implements ObjectInterface, ProductFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
    private Product $productFavourite;
}

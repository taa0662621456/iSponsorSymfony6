<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductFavouriteInterface;

#[ORM\Entity]
class ProductFavourite extends ObjectSuperEntity implements ObjectInterface, ProductFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
    private Product $productFavourite;

}

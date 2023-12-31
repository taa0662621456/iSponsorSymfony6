<?php

namespace App\Entity\Product;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductFavouriteInterface;

#[ORM\Entity]
class ProductFavourite extends RootEntity implements ObjectInterface, ProductFavouriteInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
    private Product $productFavourite;
}

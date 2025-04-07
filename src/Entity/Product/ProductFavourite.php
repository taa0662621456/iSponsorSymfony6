<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductFavouriteInterface;

#[ORM\Entity]
class ProductFavourite extends RootEntity implements ObjectInterface, ProductFavouriteInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
    private Product $productFavourite;
}

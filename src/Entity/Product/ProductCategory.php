<?php

namespace App\Entity\Product;

use App\Embeddable\Category\Category;
use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class ProductCategory extends RootEntity implements ObjectInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


    #[ORM\Embedded(class: 'ProductCategory')]
    private Category $category;
}

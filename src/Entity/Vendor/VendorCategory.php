<?php

namespace App\Entity\Vendor;

use App\Embeddable\Category\Category;
use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class VendorCategory extends RootEntity implements ObjectInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;


    #[ORM\Embedded(class: 'VendorCategory')]
    private Category $category;
}

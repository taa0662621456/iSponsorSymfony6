<?php

namespace App\Entity\Product;

use App\Embeddable\Object\ObjectProperty;
use App\Embeddable\Title\ObjectTitle;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductTitleInterface;

#[ORM\Entity]
class ProductEnGb extends RootEntity implements ObjectInterface, ProductTitleInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


    #[ORM\Embedded(class: "ObjectTitle")]
    private ObjectTitle $vendorTitle;
}

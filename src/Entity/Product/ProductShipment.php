<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductShipmentInterface;

#[ORM\Entity]
class ProductShipment extends RootEntity implements ObjectInterface, ProductShipmentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


}

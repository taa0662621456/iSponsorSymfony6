<?php

namespace App\Entity\Product;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Product\ProductShipmentInterface;

#[ORM\Entity]
class ProductShipment extends RootEntity implements ObjectInterface, ProductShipmentInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'product')]
    private ObjectProperty $objectProperty;


}

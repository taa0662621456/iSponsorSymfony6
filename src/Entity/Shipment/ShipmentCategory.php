<?php

namespace App\Entity\Shipment;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentCategoryInterface;

#[ORM\Entity]
class ShipmentCategory extends RootEntity implements ObjectInterface, ShipmentCategoryInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


}

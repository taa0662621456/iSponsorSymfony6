<?php

namespace App\Entity\Shipment;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentCategoryInterface;

#[ORM\Entity]
class ShipmentCategory extends RootEntity implements ObjectInterface, ShipmentCategoryInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'shipment')]
    private ObjectProperty $objectProperty;


}

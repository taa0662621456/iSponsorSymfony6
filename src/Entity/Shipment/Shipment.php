<?php

namespace App\Entity\Shipment;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentInterface;

#[ORM\Entity]
class Shipment extends RootEntity implements ObjectInterface, ShipmentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

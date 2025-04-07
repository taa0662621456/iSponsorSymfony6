<?php

namespace App\Entity\Order;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderShipmentInterface;

#[ORM\Entity]
class OrderShipment extends RootEntity implements ObjectInterface, OrderShipmentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

<?php

namespace App\Entity\Order;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderShipmentInterface;

#[ORM\Entity]
class OrderShipment extends RootEntity implements ObjectInterface, OrderShipmentInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'order')]
    private ObjectProperty $objectProperty;

}

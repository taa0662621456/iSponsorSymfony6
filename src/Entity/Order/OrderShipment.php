<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderShipmentInterface;

#[ORM\Entity]
class OrderShipment extends ObjectSuperEntity implements ObjectInterface, OrderShipmentInterface
{
}

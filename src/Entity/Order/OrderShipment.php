<?php

namespace App\Entity\Order;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderShipmentInterface;

#[ORM\Entity]
class OrderShipment extends RootEntity implements ObjectInterface, OrderShipmentInterface
{
}

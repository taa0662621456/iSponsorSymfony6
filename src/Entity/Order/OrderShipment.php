<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderShipmentInterface;

#[ORM\Entity]
final class OrderShipment extends ObjectSuperEntity implements ObjectInterface, OrderShipmentInterface
{
}

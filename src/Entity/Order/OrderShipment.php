<?php

namespace App\Entity\Order;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderShipmentInterface;
use App\Repository\OrderShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'order_shipment')]
#[ORM\Index(columns: ['slug'], name: 'order_shipment_idx')]
#[ORM\Entity(repositoryClass: OrderShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class OrderShipment extends ObjectSuperEntity implements ObjectInterface, OrderShipmentInterface
{

}

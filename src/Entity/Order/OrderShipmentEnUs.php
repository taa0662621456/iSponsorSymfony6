<?php

namespace App\Entity\Order;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\OrderShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'order_shipment_en')]
#[ORM\Index(columns: ['slug'], name: 'order_shipment_idx')]
#[ORM\Entity(repositoryClass: OrderShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class OrderShipmentEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

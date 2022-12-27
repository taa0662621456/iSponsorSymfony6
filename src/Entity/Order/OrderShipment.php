<?php

namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'order_shipment')]
#[ORM\Index(columns: ['slug'], name: 'order_shipment_idx')]
#[ORM\Entity(repositoryClass: OrderShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderShipment
{
    use BaseTrait;
    use ObjectTrait;

}

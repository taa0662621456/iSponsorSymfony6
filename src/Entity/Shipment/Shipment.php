<?php

namespace App\Entity\Shipment;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Shipment\ShipmentInterface;
use App\Repository\Shipment\ShipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment')]
#[ORM\Index(columns: ['slug'], name: 'shipment_idx')]
#[ORM\Entity(repositoryClass: ShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Shipment extends ObjectSuperEntity implements ObjectInterface, ShipmentInterface
{
}

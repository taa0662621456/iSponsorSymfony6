<?php

namespace App\Entity\Shipment;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\ShipmentEnUsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_enus')]
#[ORM\Index(columns: ['slug'], name: 'shipment_enus_idx')]
#[ORM\Entity(repositoryClass: ShipmentEnUsRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ShipmentEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

<?php

namespace App\Entity\Shipment;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Shipment\ShipmentMethodInterface;
use App\Repository\Shipment\ShipmentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'shipment_method')]
#[ORM\Index(columns: ['slug'], name: 'shipment_method_idx')]
#[ORM\Entity(repositoryClass: ShipmentMethodRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class ShipmentMethod extends ObjectSuperEntity implements ObjectInterface, ShipmentMethodInterface
{
}

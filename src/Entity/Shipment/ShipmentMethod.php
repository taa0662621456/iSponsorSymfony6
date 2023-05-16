<?php

namespace App\Entity\Shipment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Shipment\ShipmentMethodInterface;

#[ORM\Entity]
final class ShipmentMethod extends ObjectSuperEntity implements ObjectInterface, ShipmentMethodInterface
{
}

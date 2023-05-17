<?php

namespace App\Entity\Shipment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentMethodInterface;

#[ORM\Entity]
class ShipmentMethod extends ObjectSuperEntity implements ObjectInterface, ShipmentMethodInterface
{
}

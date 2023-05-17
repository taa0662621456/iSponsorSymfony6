<?php

namespace App\Entity\Shipment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentInterface;

#[ORM\Entity]
class Shipment extends ObjectSuperEntity implements ObjectInterface, ShipmentInterface
{
}

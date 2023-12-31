<?php

namespace App\Entity\Shipment;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentInterface;

#[ORM\Entity]
class Shipment extends RootEntity implements ObjectInterface, ShipmentInterface
{
}

<?php

namespace App\Entity\Shipment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
class ShipmentCategoryEn extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

<?php

namespace App\Entity\Shipment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Shipment\ShipmentCategoryInterface;

#[ORM\Entity]
final class ShipmentCategory extends ObjectSuperEntity implements ObjectInterface, ShipmentCategoryInterface
{
}

<?php

namespace App\Entity\Shipment;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Shipment\ShipmentCategoryInterface;

#[ORM\Entity]
class ShipmentCategory extends RootEntity implements ObjectInterface, ShipmentCategoryInterface
{
}

<?php

namespace App\Entity\Shipment;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class ShipmentEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
}

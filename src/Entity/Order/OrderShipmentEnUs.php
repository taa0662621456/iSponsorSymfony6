<?php

namespace App\Entity\Order;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class OrderShipmentEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
}

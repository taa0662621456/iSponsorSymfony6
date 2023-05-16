<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
final class OrderPaymentEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

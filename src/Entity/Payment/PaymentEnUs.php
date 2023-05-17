<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
class PaymentEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

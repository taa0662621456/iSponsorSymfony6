<?php

namespace App\Entity\Payment;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class PaymentEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
}

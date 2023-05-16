<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderPaymentInterface;

#[ORM\Entity]
final class OrderPayment extends ObjectSuperEntity implements ObjectInterface, OrderPaymentInterface
{
}

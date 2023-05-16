<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderBillingInterface;

#[ORM\Entity]
final class OrderBilling extends ObjectSuperEntity implements ObjectInterface, OrderBillingInterface
{
}

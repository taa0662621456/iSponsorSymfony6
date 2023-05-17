<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderBillingInterface;

#[ORM\Entity]
class OrderBilling extends ObjectSuperEntity implements ObjectInterface, OrderBillingInterface
{
}

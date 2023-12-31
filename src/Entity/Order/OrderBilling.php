<?php

namespace App\Entity\Order;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderBillingInterface;

#[ORM\Entity]
class OrderBilling extends RootEntity implements ObjectInterface, OrderBillingInterface
{
}

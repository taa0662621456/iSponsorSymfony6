<?php

namespace App\Entity\Order;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Order\OrderDiscountInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderLogInterface;

#[ORM\Entity]
class OrderDiscount extends RootEntity implements ObjectInterface, OrderDiscountInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'order')]
    private ObjectProperty $objectProperty;

}

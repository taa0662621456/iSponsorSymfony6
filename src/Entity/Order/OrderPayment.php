<?php

namespace App\Entity\Order;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderPaymentInterface;

#[ORM\Entity]
class OrderPayment extends RootEntity implements ObjectInterface, OrderPaymentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

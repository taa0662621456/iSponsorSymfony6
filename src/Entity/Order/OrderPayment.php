<?php

namespace App\Entity\Order;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Order\OrderPaymentInterface;

#[ORM\Entity]
class OrderPayment extends RootEntity implements ObjectInterface, OrderPaymentInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'order')]
    private ObjectProperty $objectProperty;

}

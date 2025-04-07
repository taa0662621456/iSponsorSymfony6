<?php

namespace App\Entity\Order;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectTitleInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class OrderShipmentEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

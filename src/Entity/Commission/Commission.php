<?php

namespace App\Entity\Commission;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Commission\CommissionInterface;

#[ORM\Entity]
class Commission extends RootEntity implements ObjectInterface, CommissionInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


}

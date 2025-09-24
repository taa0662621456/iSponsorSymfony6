<?php

namespace App\Entity\Promotion;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyInterface;

#[ORM\Entity]
class Promotion extends RootEntity implements ObjectInterface, PropertyInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


}
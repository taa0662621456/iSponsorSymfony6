<?php

namespace App\Entity\Property;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectTitleInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyTitleInterface;

#[ORM\Entity]
class PropertyEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


}

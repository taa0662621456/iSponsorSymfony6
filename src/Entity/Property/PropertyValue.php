<?php

namespace App\Entity\Property;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyValueInterface;

#[ORM\Entity]
class PropertyValue extends RootEntity implements ObjectInterface, PropertyValueInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'object')]
    private ObjectProperty $objectProperty;


}

<?php

namespace App\Entity\Property;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyValueInterface;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class PropertyValue extends ObjectSuperEntity implements ObjectInterface, PropertyValueInterface
{
}

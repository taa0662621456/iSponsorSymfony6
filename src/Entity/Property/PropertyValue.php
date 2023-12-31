<?php

namespace App\Entity\Property;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyValueInterface;

#[ORM\Entity]
class PropertyValue extends RootEntity implements ObjectInterface, PropertyValueInterface
{
}

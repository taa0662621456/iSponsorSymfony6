<?php

namespace App\Entity\Property;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Property\PropertyValueInterface;

final class PropertyValue extends ObjectSuperEntity implements ObjectInterface, PropertyValueInterface
{

}

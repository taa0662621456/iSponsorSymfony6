<?php

namespace App\Entity\Property;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyInterface;

#[ORM\Entity]
class Property extends ObjectSuperEntity implements ObjectInterface, PropertyInterface
{
}

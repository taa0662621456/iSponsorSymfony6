<?php

namespace App\Entity\Property;

use App\Entity\RootEntity;

use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyInterface;

#[ORM\Entity]
class Property extends RootEntity implements ObjectInterface, PropertyInterface
{
}

<?php

namespace App\Entity\Property;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Property\PropertyInterface;

#[ORM\Entity]
final class Property extends ObjectSuperEntity implements ObjectInterface, PropertyInterface
{
}

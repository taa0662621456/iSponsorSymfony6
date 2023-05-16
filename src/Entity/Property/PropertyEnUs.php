<?php

namespace App\Entity\Property;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
final class PropertyEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

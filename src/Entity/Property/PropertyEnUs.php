<?php

namespace App\Entity\Property;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class PropertyEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

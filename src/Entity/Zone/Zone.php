<?php

namespace App\Entity\Zone;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Zone\ZoneInterface;

#[ORM\Entity]
class Zone extends ObjectSuperEntity implements ObjectInterface, ZoneInterface
{
}

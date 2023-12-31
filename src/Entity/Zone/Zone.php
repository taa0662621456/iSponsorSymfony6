<?php

namespace App\Entity\Zone;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Zone\ZoneInterface;

#[ORM\Entity]
class Zone extends RootEntity implements ObjectInterface, ZoneInterface
{
}

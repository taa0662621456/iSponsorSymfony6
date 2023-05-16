<?php

namespace App\Entity\Zone;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Zone\ZoneFactoryInterface;

#[ORM\Entity]
final class Zone extends ObjectSuperEntity implements ObjectInterface, ZoneFactoryInterface
{
}

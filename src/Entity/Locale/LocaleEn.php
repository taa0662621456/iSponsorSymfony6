<?php

namespace App\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
class LocaleEn extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

<?php

namespace App\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Locale\LocaleInterface;

#[ORM\Entity]
class Locale extends ObjectSuperEntity implements ObjectInterface, LocaleInterface
{
}

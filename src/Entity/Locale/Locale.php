<?php

namespace App\Entity\Locale;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Locale\LocaleInterface;

#[ORM\Entity]
class Locale extends RootEntity implements ObjectInterface, LocaleInterface
{
}

<?php

namespace App\Entity\Locale;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class LocaleEn extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
}

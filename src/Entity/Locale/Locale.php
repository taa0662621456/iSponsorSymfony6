<?php

namespace App\Entity\Locale;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Locale\LocaleInterface;

#[ORM\Entity]
class Locale extends RootEntity implements ObjectInterface, LocaleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

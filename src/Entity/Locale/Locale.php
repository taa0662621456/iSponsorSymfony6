<?php

namespace App\Entity\Locale;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Locale\LocaleInterface;

#[ORM\Entity]
class Locale extends RootEntity implements ObjectInterface, LocaleInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'locale')]
    private ObjectProperty $objectProperty;

}

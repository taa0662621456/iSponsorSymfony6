<?php

namespace App\Entity\Currency;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Currency\CurrencyInterface;

#[ORM\Entity]
class Currency extends RootEntity implements ObjectInterface, CurrencyInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

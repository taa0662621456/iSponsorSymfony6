<?php

namespace App\Entity\Currency;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Currency\CurrencyInterface;

#[ORM\Entity]
class Currency extends ObjectSuperEntity implements ObjectInterface, CurrencyInterface
{

}

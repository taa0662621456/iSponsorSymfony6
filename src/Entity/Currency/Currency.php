<?php

namespace App\Entity\Currency;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Currency\CurrencyInterface;

#[ORM\Entity]
class Currency extends RootEntity implements ObjectInterface, CurrencyInterface
{
}

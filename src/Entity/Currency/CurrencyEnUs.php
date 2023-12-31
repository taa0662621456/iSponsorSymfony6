<?php

namespace App\Entity\Currency;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class CurrencyEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
}

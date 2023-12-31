<?php

namespace App\Entity\Taxation;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationRateValueInterface;

#[ORM\Entity]
class TaxationRateValue extends RootEntity implements ObjectInterface, TaxationRateValueInterface
{
}

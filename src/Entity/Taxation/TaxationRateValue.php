<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationRateValueInterface;

#[ORM\Entity]
class TaxationRateValue extends ObjectSuperEntity implements ObjectInterface, TaxationRateValueInterface
{
}

<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationRateValueInterface;

#[ORM\Entity]
final class TaxationRateValue extends ObjectSuperEntity implements ObjectInterface, TaxationRateValueInterface
{
}

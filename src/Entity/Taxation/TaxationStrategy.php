<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationStrategyInterface;

#[ORM\Entity]
class TaxationStrategy extends ObjectSuperEntity implements ObjectInterface, TaxationStrategyInterface
{
}

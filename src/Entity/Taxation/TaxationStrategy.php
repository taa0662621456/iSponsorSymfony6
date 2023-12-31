<?php

namespace App\Entity\Taxation;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationStrategyInterface;

#[ORM\Entity]
class TaxationStrategy extends RootEntity implements ObjectInterface, TaxationStrategyInterface
{
}

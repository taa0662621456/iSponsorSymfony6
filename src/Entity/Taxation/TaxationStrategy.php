<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationStrategyInterface;

#[ORM\Entity]
final class TaxationStrategy extends ObjectSuperEntity implements ObjectInterface, TaxationStrategyInterface
{
}

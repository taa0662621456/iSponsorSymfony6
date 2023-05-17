<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationInterface;

#[ORM\Entity]
class Taxation extends ObjectSuperEntity implements ObjectInterface, TaxationInterface
{
}

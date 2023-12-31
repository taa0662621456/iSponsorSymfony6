<?php

namespace App\Entity\Taxation;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationInterface;

#[ORM\Entity]
class Taxation extends RootEntity implements ObjectInterface, TaxationInterface
{
}

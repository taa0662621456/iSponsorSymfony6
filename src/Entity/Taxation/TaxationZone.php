<?php

namespace App\Entity\Taxation;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationZoneInterface;

#[ORM\Entity]
class TaxationZone extends RootEntity implements ObjectInterface, TaxationZoneInterface
{
}

<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationZoneInterface;

#[ORM\Entity]
class TaxationZone extends ObjectSuperEntity implements ObjectInterface, TaxationZoneInterface
{
}

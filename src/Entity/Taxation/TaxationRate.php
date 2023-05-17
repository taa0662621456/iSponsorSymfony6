<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class TaxationRate extends ObjectSuperEntity implements ObjectInterface
{
}

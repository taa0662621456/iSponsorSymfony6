<?php

namespace App\Entity\Taxation;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class TaxationRate extends RootEntity implements ObjectInterface
{
}

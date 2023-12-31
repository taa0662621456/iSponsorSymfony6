<?php

namespace App\Entity\Promotion;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyInterface;

#[ORM\Entity]
class Promotion extends RootEntity implements ObjectInterface, PropertyInterface
{
}

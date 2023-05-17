<?php

namespace App\Entity\Promotion;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyInterface;

#[ORM\Entity]
class PromotionCatalog extends ObjectSuperEntity implements ObjectInterface, PropertyInterface
{
}

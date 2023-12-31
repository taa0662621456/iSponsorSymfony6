<?php

namespace App\Entity\Promotion;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Property\PropertyInterface;

#[ORM\Entity]
class PromotionCatalog extends RootEntity implements ObjectInterface, PropertyInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'promotion')]
    private ObjectProperty $objectProperty;


}

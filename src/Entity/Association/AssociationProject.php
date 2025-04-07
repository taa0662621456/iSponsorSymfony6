<?php

namespace App\Entity\Association;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AssociationProject extends RootEntity
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;
}

<?php

namespace App\Entity\Association;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AssociationProjectType extends RootEntity
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'association')]
    private ObjectProperty $objectProperty;
}

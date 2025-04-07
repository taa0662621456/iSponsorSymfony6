<?php

namespace App\Entity\Module;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Module\ModuleMenuInterface;

#[ORM\Entity]
class ModuleMenu extends RootEntity implements ObjectInterface, ModuleMenuInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

<?php

namespace App\Entity\Module;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Module\ModuleMenuInterface;

#[ORM\Entity]
class ModuleMenu extends RootEntity implements ObjectInterface, ModuleMenuInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'module')]
    private ObjectProperty $objectProperty;

}

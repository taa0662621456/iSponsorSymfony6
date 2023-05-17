<?php

namespace App\Entity\Module;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Module\ModuleMenuInterface;

#[ORM\Entity]
class ModuleMenu extends ObjectSuperEntity implements ObjectInterface, ModuleMenuInterface
{
}

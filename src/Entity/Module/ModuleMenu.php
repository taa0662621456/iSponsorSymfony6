<?php

namespace App\Entity\Module;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Module\ModuleMenuInterface;

#[ORM\Entity]
class ModuleMenu extends RootEntity implements ObjectInterface, ModuleMenuInterface
{
}

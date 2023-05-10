<?php

namespace App\Entity\Module;

use App\Entity\ObjectSuperEntity;
use App\Interface\Module\ModuleMenuInterface;
use App\Interface\Object\ObjectInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'module_menu')]
#[ORM\Entity]
final class ModuleMenu extends ObjectSuperEntity implements ObjectInterface, ModuleMenuInterface
{

}

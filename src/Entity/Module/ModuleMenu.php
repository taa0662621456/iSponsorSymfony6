<?php

namespace App\Entity\Module;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Module\ModuleMenuInterface;

#[ORM\Entity]
final class ModuleMenu extends ObjectSuperEntity implements ObjectInterface, ModuleMenuInterface
{
}

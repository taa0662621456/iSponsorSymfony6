<?php

namespace App\Entity\Module;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'modules_menu')]
#[ORM\Entity]
class ModuleMenu
{
    use BaseTrait;
}

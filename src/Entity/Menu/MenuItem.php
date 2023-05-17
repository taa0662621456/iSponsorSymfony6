<?php

namespace App\Entity\Menu;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Menu\MenuItemInterface;

#[ORM\Entity]
class MenuItem extends ObjectSuperEntity implements ObjectInterface, MenuItemInterface
{
}

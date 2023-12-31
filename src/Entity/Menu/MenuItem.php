<?php

namespace App\Entity\Menu;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Menu\MenuItemInterface;

#[ORM\Entity]
class MenuItem extends RootEntity implements ObjectInterface, MenuItemInterface
{
}

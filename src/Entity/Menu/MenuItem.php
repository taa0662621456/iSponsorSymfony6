<?php

namespace App\Entity\Menu;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Menu\MenuItemInterface;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
final class MenuItem extends ObjectSuperEntity implements ObjectInterface, MenuItemInterface
{
}

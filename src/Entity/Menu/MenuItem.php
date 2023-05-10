<?php

namespace App\Entity\Menu;

use App\Entity\ObjectSuperEntity;
use App\Interface\Menu\MenuItemInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Menu\MenuItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'menu_item')]
#[ORM\Index(columns: ['slug'], name: 'menu_item_idx')]
#[ORM\Entity(repositoryClass: MenuItemRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class MenuItem extends ObjectSuperEntity implements ObjectInterface, MenuItemInterface
{

}

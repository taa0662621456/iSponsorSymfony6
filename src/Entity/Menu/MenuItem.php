<?php

namespace App\Entity\Menu;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Menu\MenuItemInterface;

#[ORM\Entity]
class MenuItem extends RootEntity implements ObjectInterface, MenuItemInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

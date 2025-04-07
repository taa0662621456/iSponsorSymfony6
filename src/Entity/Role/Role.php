<?php

namespace App\Entity\Role;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Role\RoleInterface;

#[ORM\Entity]
class Role extends RootEntity implements ObjectInterface, RoleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


}

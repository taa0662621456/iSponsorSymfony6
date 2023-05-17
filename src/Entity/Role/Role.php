<?php

namespace App\Entity\Role;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Role\RoleInterface;

#[ORM\Entity]
class Role extends ObjectSuperEntity implements ObjectInterface, RoleInterface
{
}

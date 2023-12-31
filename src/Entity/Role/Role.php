<?php

namespace App\Entity\Role;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Role\RoleInterface;

#[ORM\Entity]
class Role extends RootEntity implements ObjectInterface, RoleInterface
{
}

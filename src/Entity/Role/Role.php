<?php

namespace App\Entity\Role;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Role\RoleInterface;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
final class Role extends ObjectSuperEntity implements ObjectInterface, RoleInterface
{
}

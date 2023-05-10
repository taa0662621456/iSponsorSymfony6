<?php

namespace App\Entity\Role;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Role\RoleInterface;
use App\Repository\Role\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'role')]
#[ORM\Index(columns: ['slug'], name: 'role_idx')]
#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Role extends ObjectSuperEntity implements ObjectInterface, RoleInterface
{
}

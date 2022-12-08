<?php

namespace App\Entity\Role;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Role\RoleRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'role')]
#[ORM\Index(columns: ['slug'], name: 'role_idx')]
#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Role
{

    use BaseTrait;
    use ObjectTrait;

}

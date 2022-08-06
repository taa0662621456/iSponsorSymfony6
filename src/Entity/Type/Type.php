<?php

namespace App\Entity\Type;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Type\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'type')]
#[ORM\Index(columns: ['slug'], name: 'type_idx')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    use BaseTrait;
    use ObjectTrait;

}

<?php

namespace App\Entity\Category;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'category_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'category_en_gb_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class CategoryEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{

}

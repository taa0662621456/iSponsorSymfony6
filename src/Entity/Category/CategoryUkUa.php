<?php

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\CategoryLanguageTrait;
use App\Entity\ObjectTrait;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;



#[ORM\Table(name: 'category_uk_ua')]
#[ORM\Index(columns: ['slug'], name: 'category_uk_ua_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class CategoryUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use CategoryLanguageTrait;
}

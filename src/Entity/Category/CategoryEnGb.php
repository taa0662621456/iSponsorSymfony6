<?php

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\CategoryLanguageTrait;
use App\Entity\ObjectTrait;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'categories_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'category_en_gb_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class CategoryEnGb
{
    use CategoryLanguageTrait;
    use ObjectTrait;
    use BaseTrait;
}

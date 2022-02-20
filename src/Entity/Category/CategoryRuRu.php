<?php


namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\CategoryLanguageTrait;
use App\Entity\ObjectTrait;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;




#[ORM\Table(name: 'categories_ru_ru')]
#[ORM\Index(columns: ['slug'], name: 'category_ru_ru_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class CategoryRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use CategoryLanguageTrait;
}

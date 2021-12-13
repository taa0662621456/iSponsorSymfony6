<?php

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\CategoryLanguageTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="categories_en_gb", indexes={
 * @ORM\Index(name="category_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoryEnGb
{
    use CategoryLanguageTrait;
    use ObjectTrait;
    use BaseTrait;
}

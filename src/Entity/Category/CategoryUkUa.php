<?php

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\CategoryLanguageTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Table(name="categories_uk_ua", indexes={
 * @ORM\Index(name="category_uk_ua_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoryUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use CategoryLanguageTrait;
}

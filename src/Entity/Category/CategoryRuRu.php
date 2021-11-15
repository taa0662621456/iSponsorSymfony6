<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\OAuthTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Table(name="categories_ru_ru", indexes={
 * @ORM\Index(name="category_ru_ru_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class CategoryRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use CategoryLanguageTrait;
}

<?php

namespace App\Entity\Category;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class CategoryEnGb extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\OneToOne(targetEntity: Category::class, inversedBy: 'categoryEnGb')]
    private $categoryEnGb;
}

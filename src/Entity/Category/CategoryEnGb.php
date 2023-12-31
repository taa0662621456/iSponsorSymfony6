<?php

namespace App\Entity\Category;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class CategoryEnGb extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'category')]
    private ObjectProperty $objectProperty;


    #[ORM\OneToOne(inversedBy: 'categoryEnGb', targetEntity: Category::class)]
    private $categoryEnGb;
}

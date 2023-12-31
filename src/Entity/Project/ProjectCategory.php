<?php

namespace App\Entity\Project;

use App\Embeddable\Category\Category;
use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class ProjectCategory extends RootEntity implements ObjectInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'project')]
    private ObjectProperty $objectProperty;


    #[ORM\Embedded(class: 'ProjectCategory')]
    private Category $category;
}

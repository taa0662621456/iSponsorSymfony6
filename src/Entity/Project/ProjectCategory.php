<?php

namespace App\Entity\Project;

use App\Entity\Embeddable\Category\Category;
use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class ProjectCategory extends RootEntity implements ObjectInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

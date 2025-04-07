<?php

namespace App\Entity\Tag;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Tag\TagInterface;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class Tag extends RootEntity implements ObjectInterface, TagInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

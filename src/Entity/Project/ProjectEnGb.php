<?php

namespace App\Entity\Project;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectTitleInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ProjectLanguageTrait;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectTitleInterface;

#[ORM\Entity]
class ProjectEnGb extends RootEntity implements ObjectInterface, ObjectTitleInterface, ProjectTitleInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    use ProjectLanguageTrait;
}

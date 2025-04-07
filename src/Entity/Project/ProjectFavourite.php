<?php

namespace App\Entity\Project;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectFavouriteInterface;

#[ORM\Entity]
class ProjectFavourite extends RootEntity implements ObjectInterface, ProjectFavouriteInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourite')]
    private int $projectFavourite;
}

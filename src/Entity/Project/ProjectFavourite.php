<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectFavouriteInterface;

#[ORM\Entity]
class ProjectFavourite extends ObjectSuperEntity implements ObjectInterface, ProjectFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourite')]
    private int $projectFavourite;

}

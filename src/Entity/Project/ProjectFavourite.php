<?php

namespace App\Entity\Project;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Project\ProjectFavouriteInterface;

#[ORM\Entity]
class ProjectFavourite extends RootEntity implements ObjectInterface, ProjectFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourite')]
    private int $projectFavourite;
}

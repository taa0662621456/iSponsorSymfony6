<?php

namespace App\Entity\Project;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectFavouriteInterface;

#[ORM\Entity]
final class ProjectFavourite extends ObjectSuperEntity implements ObjectInterface, ProjectFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourite')]
    private int $projectFavourite;

    // ManyToMany
    public function getProjectFavourite(): int
    {
        return $this->projectFavourite;
    }

    public function setProjectFavourite(int $projectFavourite): void
    {
        $this->projectFavourite = $projectFavourite;
    }
}

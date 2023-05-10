<?php

namespace App\Entity\Project;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectFavouriteInterface;
use App\Repository\Project\ProjectFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

// #[ApiResource(operations: [
//    new Get(),
//    new GetCollection()
// ]
// )]
#[ORM\Table(name: 'project_favourite')]
#[ORM\Index(columns: ['slug'], name: 'project_favourite_idx')]
#[ORM\Entity(repositoryClass: ProjectFavouriteRepository::class)]
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

<?php

namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Repository\Project\ProjectFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

//#[ApiResource(operations: [
//    new Get(),
//    new GetCollection()
//]
//)]
#[ORM\Table(name: 'project_favourite')]
#[ORM\Index(columns: ['slug'], name: 'project_favourite_idx')]
#[ORM\Entity(repositoryClass: ProjectFavouriteRepository::class)]
#
#[ApiResource]

class ProjectFavourite
{
	use BaseTrait;

	#[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourite')]
	private int $projectFavourite;
    # ManyToMany
    public function getProjectFavourite(): int
    {
        return $this->projectFavourite;
    }
	public function setProjectFavourite(int $projectFavourite): void
    {
		$this->projectFavourite = $projectFavourite;
	}

}

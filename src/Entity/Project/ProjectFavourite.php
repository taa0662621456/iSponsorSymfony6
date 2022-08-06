<?php


namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Repository\Project\ProjectFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'project_favourite')]
#[ORM\Index(columns: ['slug'], name: 'project_favourite_idx')]
#[ORM\Entity(repositoryClass: ProjectFavouriteRepository::class)]
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

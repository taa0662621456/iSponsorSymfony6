<?php


namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Repository\Project\ProjectFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'projects_favourites')]
#[ORM\Index(columns: ['slug'], name: 'project_favourite_idx')]
#[ORM\Entity(repositoryClass: ProjectFavouriteRepository::class)]
class ProjectFavourite
{
	use BaseTrait;

	#[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourites')]
	#[ORM\JoinColumn(name: 'projectFavourites_id', referencedColumnName: 'id')]
	private int $projectFavourites;

    public function getProjectFavourites(): int
    {
        return $this->projectFavourites;
    }

	public function setProjectFavourites(int $projectFavourites): void
    {
		$this->projectFavourites = $projectFavourites;
	}

}

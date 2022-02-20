<?php


namespace App\Entity\Project;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'projects_favourites')]
#[ORM\Index(columns: ['slug'], name: 'project_favourite_idx')]
class ProjectFavourite
{
	use BaseTrait;
	#[ORM\ManyToMany(targetEntity: Project::class, inversedBy: 'projectFavourites')]
	#[ORM\JoinColumn(name: 'projectFavourites_id', referencedColumnName: 'id')]
	private Project $projectFavourites;
	/**
	 * @param Project|null $projectFavourites
	 */
	public function setProjectFavourites(Project $projectFavourites = null): ProjectFavourite
	{
		$this->projectFavourites = $projectFavourites;

		return $this;
	}
	public function getProjectFavourites(): Project
 {
     return $this->projectFavourites;
 }
}

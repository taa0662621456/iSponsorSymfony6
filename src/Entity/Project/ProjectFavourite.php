<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="projects_favourites", indexes={
 * @ORM\Index(name="project_favourite_idx", columns={"slug"})}))
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductFavouriteRepository")
 */
class ProjectFavourite
{
	use BaseTrait;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Project\Project", inversedBy="projectFavourites")
	 * @ORM\JoinColumn(name="projectFavourites_id", referencedColumnName="id")
	 **/
	private Project $projectFavourites;


	/**
	 * @param Project $projectFavourites
	 *
	 * @return ProjectFavourite
	 */
	public function setProjectFavourites(Project $projectFavourites = null): ProjectFavourite
	{
		$this->projectFavourites = $projectFavourites;

		return $this;
	}

    /**
     * @return Project
     */
    public function getProjectFavourites(): Project
    {
        return $this->projectFavourites;
    }

}

<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="projects_favourites", indexes={
 * @ORM\Index(name="project_favourite_slug", columns={"slug"})}))
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductsFavouritesRepository")
 */
class ProjectsFavourites
{
	use BaseTrait;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Project\Projects", inversedBy="projectFavourites")
	 * @ORM\JoinColumn(name="projectFavourites_id", referencedColumnName="id")
	 **/
	private $projectFavourites;


	/**
	 * @param Projects $projectFavourites
	 *
	 * @return ProjectsFavourites
	 */
	public function setProjectFavourites(Projects $projectFavourites = null): ProjectsFavourites
	{
		$this->projectFavourites = $projectFavourites;

		return $this;
	}

    /**
     * @return Projects
     */
    public function getProjectFavourites(): Projects
    {
        return $this->projectFavourites;
    }

}

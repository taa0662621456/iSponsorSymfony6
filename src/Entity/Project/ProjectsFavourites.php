<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\EntitySystemTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectsFavourites
 *
 * @ORM\Table(name="projects_favourites")
 * @ORM\Entity(repositoryClass="App\Repository\ProductsFavouritesRepository")
 */
class ProjectsFavourites
{
	use EntitySystemTrait;

    /**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Project\Projects", inversedBy="projectFavourites")
	 * @ORM\JoinColumn(name="projectFavourites_id", referencedColumnName="id")
     **/
    private $projectFavourites;



    /**
     * @param Projects $projectFavourites
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

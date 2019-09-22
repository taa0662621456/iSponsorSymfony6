<?php
declare(strict_types=1);

namespace App\Entity\Project;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * ProjectsFavourites
 *
 * @ORM\Table(name="projects_favourites")
 * @ORM\Entity(repositoryClass="App\Repository\ProductsFavouritesRepository")
 */
class ProjectsFavourites
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project\Projects", inversedBy="projectFavourites")
     * @ORM\JoinColumn(name="projectFavourites_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     **/
    private $projectFavourites;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $modifiedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=false)
     */
    private $modifiedBy = 0;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="locked_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $lockedOn;

    /**
     * @var int
     *
     * @ORM\Column(name="locked_by", type="integer", nullable=false)
     */
    private $lockedBy = 0;


    /**
     * ProjectsFavorites constructor.
     */
    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->lockedOn = new DateTime();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

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


    /**
     * @return integer
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     * @return void
     */
    public function setCreatedBy(string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return DateTime
     */

    public function getCreatedOn(): DateTime
    {
        return $this->createdOn;
    }

    /**
     * @ORM\PrePersist
     * @return void
     * @throws Exception
     */
    public function setCreatedOn(): void
    {
        $this->createdOn = new DateTime();
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param DateTime $lockedOn
     */
    public function setLockedOn(DateTime $lockedOn): void
    {
        $this->lockedOn = $lockedOn;
    }

    /**
     * @return int
     */
    public function getLockedBy(): int
    {
        return $this->lockedBy;
    }

    /**
     * @param int $lockedBy
     */
    public function setLockedBy(int $lockedBy): void
    {
        $this->lockedBy = $lockedBy;
    }


}

<?php
declare(strict_types=1);

namespace App\Entity\Project;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="projects")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 */
class Projects
{
    public const NUM_ITEMS = 10;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false)
     */
    private $ordering = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories", inversedBy="ca")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="string", nullable=false, options={"default":0})
     */
    private $createdBy = 0;

    /**
     * @var \DateTime
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
     * @var \DateTime
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
     * @ORM\OneToOne(targetEntity="ProjectsEnGb", mappedBy="projectEnGb", cascade={"persist", "remove"}, orphanRemoval=true, fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type(type="App\Entity\Project\ProjectsEnGb")
     * @Assert\Valid()
     */
    private $projectEnGb;

    /**
     * @var ProjectsTags[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Project\ProjectsTags", cascade={"persist"})
     * @ORM\JoinTable(name="project_tags")
     * @ORM\OrderBy({"name": "ASC"})
     * @Assert\Count(max="4", maxMessage="projects.too_many_tags")
     *
     */
    private $tags;

    /**
     * @var ProjectsAttachments[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsAttachments", cascade={"persist", "remove"}, mappedBy="pro")
     * @ORM\JoinTable(name="projects_attachments")
     * @Assert\Count(max="8", maxMessage="projects.too_many_files")
	 */
    private $projectAttachments;

    /**
     * @var ProjectsFavourites[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsFavourites", mappedBy="favourites")
     **/
    private $projectFavourites;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Featured", mappedBy="projectFeatured", cascade={"persist", "remove"}, orphanRemoval=true, fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $projectFeatured;














    /**
     * Projects constructor.
     */
    public function __construct()
    {
        $this->createdOn = new \DateTime();
        $this->modifiedOn = new \DateTime();
        $this->lockedOn = new \DateTime();
        $this->projectAttachments = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return integer
     */
    public function getOrdering(): int
    {
        return $this->ordering;
    }

    /**
     * @param integer $ordering
     */
    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    /**
     * @param ProjectsTags $tags
     */
    public function addTags(ProjectsTags $tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }


    /**
     * @param ProjectsTags $tag
     */
    public function removeTag(ProjectsTags $tag): void
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return Collection|ProjectsTags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param ProjectsAttachments $attachments
     */
    public function addAttachments(ProjectsAttachments $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (!$this->projectAttachments->contains($attachment)) {
                $this->projectAttachments->add($attachment);
            }
        }
    }


    /**
     * @param ProjectsAttachments $attachment
     */
    public function removeAttachments(ProjectsAttachments $attachment): void
    {
        $this->projectAttachments->removeElement($attachment);
    }

    /**
     * @return Collection|ProjectsAttachments[]
     */
    public function getAttachments(): Collection
    {
        return $this->projectAttachments;
    }

    /**
     * @return integer
     */
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     */
    public function setCreatedBy(int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }



    /**
     * @return \DateTime
     */

    public function getCreatedOn(): \DateTime
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
        $this->createdOn = new \DateTime();
    }

    /**
     * @return DateTime
     */
    public function getLockedOn(): \DateTime
    {
        return $this->lockedOn;
    }

    /**
     * @param DateTime $lockedOn
     */
    public function setLockedOn(\DateTime $lockedOn): void
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



    /**
     * @return mixed
     */
    public function getProjectEnGb()
    {
        return $this->projectEnGb;
    }

    /**
     * @param mixed $projectEnGb
     */
    public function setProjectEnGb($projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }

    /**
     * Method for get name Category by Project id
     * First: get Project object
     * Second: get associate objects
     *
     * таке будет создаваться второй запрос. Возможно в этом нет необходимости для нашей платформы
     * возможно мы сделаем это через set
     *
     * @param $id
     */
    public function show($id): void
    {
        /*
        $project = $this->getDoctrine()
            ->getRepository(ProjectsRepository::class)
            ->find($id);
        $categoryName = $project->getCategories()->getName();
        return $categoryName;
        */

    }


}
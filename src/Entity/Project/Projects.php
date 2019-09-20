<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\Category\Categories;
use \DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="projects", uniqueConstraints={
 * @ORM\UniqueConstraint(name="project_slug", columns={"project_slug"})})
 * @UniqueEntity("project_slug"),
 *		errorPath="project_slug",
 *		message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Projects
{
    public const NUM_ITEMS = 10;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_slug", type="string", nullable=true, options={"default"="project_slug"})
	 * @Assert\NotBlank(message="project_slug.blank_content")
	 * @Assert\Length(min=4, minMessage="project_slug.too_short_content")
	 */
	private $projectSlug = 'project_slug';

    /**
     * @var int
     *
     * @ORM\Column(name="ordering", type="integer", nullable=false)
     */
    private $ordering = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories", inversedBy="categoryProjects")
	 * @ORM\JoinColumn(name="categoryProject_id", referencedColumnName="id", nullable=true)
     */
    private $categoryProjects;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdOn;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by", type="string", nullable=false, options={"default" : 0})
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
     * @ORM\OneToOne(targetEntity="App\Entity\Project\ProjectsEnGb", mappedBy="projectEnGb")
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
    private $projectTags;

    /**
     * @var ProjectsAttachments[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsAttachments", mappedBy="projectAttachments")
     * ORM\JoinTable(name="projects_attachments")
     * @Assert\Count(max="8", maxMessage="projects.too_many_files")
	 */
    private $projectAttachments;

    /**
     * @var ProjectsFavourites[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsFavourites", mappedBy="project")
     **/
    private $projectFavourites;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Featured", mappedBy="projectFeatured")
     */
    private $projectFeatured;














    /**
     * Projects constructor.
     */
    public function __construct()
    {
        $this->createdOn = new DateTime();
        $this->modifiedOn = new DateTime();
        $this->lockedOn = new DateTime();
        $this->projectAttachments = new ArrayCollection();
        $this->projectTags = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Categories
     */
    public function getCategoryProjects()
    {
        return $this->categoryProjects;
    }

	/**
	 * @param Categories $categoryProjects
	 */
    public function setCategoryProjects(Categories $categoryProjects = null): void
    {
        $this->categoryProjects = $categoryProjects;
    }

	/**
	 * @return string
	 */
	public function getProjectSlug(): string
	{
		return $this->projectSlug;
	}

	/**
	 * @param string|null $projectSlug
	 *
	 * @return Projects
	 */
	public function setProjectSlug(string $projectSlug = null): self
	{
		$this->projectSlug = $projectSlug;
		return $this;
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
    public function addProjectTag(ProjectsTags $tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->projectTags->contains($tag)) {
                $this->projectTags->add($tag);
            }
        }
    }


    /**
     * @param ProjectsTags $tag
     */
    public function removeProjectTag(ProjectsTags $tag): void
    {
        $this->projectTags->removeElement($tag);
    }

    /**
     * @return Collection|ProjectsTags[]
     */
    public function getProjectTags(): Collection
    {
        return $this->projectTags;
    }

    /**
     * @param ProjectsAttachments $attachments
     */
    public function addProjectAttachment(ProjectsAttachments $attachments): void
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
    public function removeProjectAttachment(ProjectsAttachments $attachment): void
    {
        $this->projectAttachments->removeElement($attachment);
    }

    /**
     * @return Collection|ProjectsAttachments[]
     */
    public function getProjectAttachments(): Collection
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
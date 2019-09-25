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
	 * @var string|null
	 * @ORM\Column(name="project_type", type="string", nullable=true)
	 */
	private $projectType;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="published", type="integer", nullable=false, options={"default" : 1})
	 */
	private $published = 1;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Categories",
	 *      cascade={"persist"},
	 *      inversedBy="categoryProjects",
	 *      fetch="EXTRA_LAZY"
	 * )
     */
    private $projectCategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Project\ProjectsEnGb",
	 *      cascade={"persist", "remove"},
	 *      mappedBy="projectEnGb",
	 *      orphanRemoval=true
	 * )
     * @Assert\Type(type="App\Entity\Project\ProjectsEnGb")
     * @Assert\Valid()
     */
    private $projectEnGb;


    /**
     * @var ProjectsAttachments[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsAttachments",
	 *      cascade={"persist", "remove"},
	 *      mappedBy="projectAttachments",
	 *      orphanRemoval=true)
     * @ORM\JoinTable(name="project_attachments")
     * @Assert\Count(max="8", maxMessage="projects.too_many_files")
	 */
    private $projectAttachments;

    /**
     * @var ProjectsFavourites[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectsFavourites", cascade={"persist", "remove"}, mappedBy="projectFavourites")
     **/
    private $projectFavourites;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Featured",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="projectFeatured"
	 * )
     */
    private $projectFeatured;

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
	 * @return mixed
	 */
	public function getProjectCategory()
	{
		return $this->projectCategory;
	}

	/**
	 * @param Categories $projectCategory
	 */
	public function setProjectCategory(Categories $projectCategory): void
	{
		$this->projectCategory = $projectCategory;
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
	 * @return string|null
	 */
	public function getProjectType(): ?string
	{
		return $this->projectType;
	}

	/**
	 * @param string|null $projectType
	 */
	public function setProjectType(?string $projectType): void
	{
		$this->projectType = $projectType;
	}



	/**
	 * @return int
	 */
	public function getPublished(): int
	{
		return $this->published;
	}

	/**
	 * @param int $published
	 */
	public function setPublished(int $published): void
	{
		$this->published = $published;
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
	public function getModifiedOn(): DateTime
	{
		return $this->modifiedOn;
	}

	/**
	 * @param DateTime $modifiedOn
	 */
	public function setModifiedOn(DateTime $modifiedOn): void
	{
		$this->modifiedOn = $modifiedOn;
	}

	/**
	 * @return int
	 */
	public function getModifiedBy(): int
	{
		return $this->modifiedBy;
	}

	/**
	 * @param int $modifiedBy
	 */
	public function setModifiedBy(int $modifiedBy): void
	{
		$this->modifiedBy = $modifiedBy;
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


}
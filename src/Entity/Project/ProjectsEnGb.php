<?php
declare(strict_types=1);

namespace App\Entity\Project;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Projects
 *
 * @ORM\Table(name="projects_en_gb")
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsEnGbRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectsEnGb
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="Primary Key"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="project_title", type="string", nullable=false, options={"default"="project_title"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=50, minMessage="projects_en_gb.too_short_content")
     */
    private $projectTitle = 'project_title';

    /**
     * @var string
     *
     * @ORM\Column(name="project_s_desc", type="text", nullable=false, options={"default"="project_s_desc"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=50, minMessage="projects_en_gb.too_short_content")
     */
    private $projectSDesc = 'project_s_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="project_desc", type="text", nullable=false, options={"default"="project_desc"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=100, minMessage="projects_en_gb.too_short_content")
     */
    private $projectDesc = 'project_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_name", type="text", nullable=false, options={"default"="project_product_name"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=50, minMessage="projects_en_gb.too_short_content")
     */
    private $projectProductName = 'project_product_name';

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_s_desc", type="text", nullable=false, options={"default"="project_product_s_desc"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=10, minMessage="projects_en_gb.too_short_content")
     */
    private $projectProductSDesc = 'project_product_s_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_desc", type="text", nullable=false, options={"default"="project_product_desc"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=100, minMessage="projects_en_gb.too_short_content")
     */
    private $projectProductDesc = 'project_product_desc';

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_meta_desc", type="text", nullable=false, options={"default"="project_product_meta_desc"})
     */
    private $projectProductMetaDesc = 'project_product_meta_desc';

	/**
     * @var string
     *
     * @ORM\Column(name="project_product_meta_key", type="text", nullable=false, options={"default"="project_product_meta_key"})
     */
    private $projectProductMetaKey = 'project_product_meta_key';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_slug", type="string", nullable=false, options={"default"=""})
	 */
	private $projectSlug = '';

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Project\Projects", cascade={"persist", "remove"}, inversedBy="projectEnGb", orphanRemoval=true)
	 * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
	 */
	private $projectEnGb;

	/**
     * @var int
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     * ORM\ManyToOne(targetEntity="App\Entity\Vendor\Vendors")
     * ORM\JoinColumn(name="id", referencedColumnName="id", nullable=true)
     */
    private $createdBy = 0;

	/**
     * @var DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;



    /**
     * ProjectsEnGb constructor.
     * @throws Exception
     */
    public function __construct()
    {
       $this->createdOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProjectTitle(): string
    {
        return $this->projectTitle;
    }

    /**
     * @param string $projectTitle
     * @return ProjectsEnGb
     */
    public function setProjectTitle(string $projectTitle): self
    {
        $this->projectTitle = $projectTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectSDesc(): string
    {
        return $this->projectSDesc;
    }

    /**
     * @param string $projectSDesc
     * @return ProjectsEnGb
     */
    public function setProjectSDesc(string $projectSDesc): self
    {
        $this->projectSDesc = $projectSDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectDesc(): string
    {
        return $this->projectDesc;
    }

    /**
     * @param string $projectDesc
     * @return ProjectsEnGb
     */
    public function setProjectDesc(string $projectDesc): self
    {
        $this->projectDesc = $projectDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductName(): string
    {
        return $this->projectProductName;
    }

    /**
     * @param string $projectProductName
     * @return ProjectsEnGb
     */
    public function setProjectProductName(string $projectProductName): self
    {
        $this->projectProductName = $projectProductName;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductSDesc(): string
    {
        return $this->projectProductSDesc;
    }

    /**
     * @param string $projectProductSDesc
     * @return ProjectsEnGb
     */
    public function setProjectProductSDesc(string $projectProductSDesc): self
    {
        $this->projectProductSDesc = $projectProductSDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductDesc(): string
    {
        return $this->projectProductDesc;
    }

    /**
     * @param string $projectProductDesc
     * @return ProjectsEnGb
     */
    public function setProjectProductDesc(string $projectProductDesc): self
    {
        $this->projectProductDesc = $projectProductDesc;
        return $this;
    }


    /**
     * @return string
     */
    public function getProjectProductMetaDesc(): string
    {
        return $this->projectProductMetaDesc;
    }

    /**
     * @param string $projectProductMetaDesc
     * @return ProjectsEnGb
     */
    public function setProjectProductMetaDesc(string $projectProductMetaDesc): self
    {
        $this->projectProductMetaDesc = $projectProductMetaDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductMetaKey(): string
    {
        return $this->projectProductMetaKey;
    }

    /**
     * @param string $projectProductMetaKey
     * @return ProjectsEnGb
     */
    public function setProjectProductMetaKey(string $projectProductMetaKey): self
    {
        $this->projectProductMetaKey = $projectProductMetaKey;
        return $this;
    }

  	/**
	 * @return string
	 */
	public function getProjectSlug(): string
	{
		return $this->projectSlug;
	}

	/**
	 * @param string $projectSlug
	 *
	 * @return ProjectsEnGb
	 */
	public function setProjectSlug(string $projectSlug): self
	{
		$this->projectSlug = $projectSlug;
		return $this;
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



}
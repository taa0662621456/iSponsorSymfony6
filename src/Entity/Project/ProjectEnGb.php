<?php
declare(strict_types=1);

namespace App\Entity\Project;

use App\Entity\BaseTrait;

use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Table(name="projects_en_gb", indexes={
 * @ORM\Index(name="project_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectEnGbRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProjectEnGb
{
    use BaseTrait;
    use ObjectTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="project_title", type="string", nullable=false, options={"default"="project_title"})
     * @Assert\NotBlank(message="projects_en_gb.blank_content")
     * @Assert\Length(min=50, minMessage="projects_en_gb.too_short_content")
     */
    private string $projectTitle = 'project_title';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_s_desc", type="text", nullable=false, options={"default"="project_s_desc"})
	 * @Assert\NotBlank(message="projects_en_gb.blank_content")
	 * @Assert\Length(min=50, minMessage="projects_en_gb.too_short_content")
	 */
	private string $projectSDesc = 'project_s_desc';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_desc", type="text", nullable=false, options={"default"="project_desc"})
	 * @Assert\NotBlank(message="projects_en_gb.blank_content")
	 * @Assert\Length(min=100, minMessage="projects_en_gb.too_short_content")
	 */
	private string $projectDesc = 'project_desc';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_product_name", type="text", nullable=false, options={"default"="project_product_name"})
	 * @Assert\NotBlank(message="projects_en_gb.blank_content")
	 * @Assert\Length(min=50, minMessage="projects_en_gb.too_short_content")
	 */
	private string $projectProductName = 'project_product_name';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_product_s_desc", type="text", nullable=false,
	 *                                            options={"default"="project_product_s_desc"})
	 * @Assert\NotBlank(message="projects_en_gb.blank_content")
	 * @Assert\Length(min=10, minMessage="projects_en_gb.too_short_content")
	 */
	private string $projectProductSDesc = 'project_product_s_desc';

	/**
	 * @var string
	 *
	 * @ORM\Column(name="project_product_desc", type="text", nullable=false, options={"default"="project_product_desc"})
	 * @Assert\NotBlank(message="projects_en_gb.blank_content")
	 * @Assert\Length(min=100, minMessage="projects_en_gb.too_short_content")
	 */
	private string $projectProductDesc = 'project_product_desc';

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Project\Project",
	 *     inversedBy="projectEnGb"
	 *     )
	 */
	private mixed $projectEnGb;


	#[Pure] public function __toString()
	{
		return $this->getProjectTitle();
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
	 *
	 * @return ProjectEnGb
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
	 *
	 * @return ProjectEnGb
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
	 *
	 * @return ProjectEnGb
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
	 *
	 * @return ProjectEnGb
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
	 *
	 * @return ProjectEnGb
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
	 *
	 * @return ProjectEnGb
	 */
	public function setProjectProductDesc(string $projectProductDesc): self
	{
		$this->projectProductDesc = $projectProductDesc;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getProjectEnGb(): mixed
    {
		return $this->projectEnGb;
	}

	/**
	 * @param mixed $projectEnGb
	 */
	public function setProjectEnGb(mixed $projectEnGb): void
	{
		$this->projectEnGb = $projectEnGb;
	}


}

<?php


namespace App\Entity\Project;


use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

trait ProjectLanguageTrait
{

    #[ORM\Column(name: 'project_title', type: 'string', nullable: false, options: ['default' => 'project_title'])]
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 50, minMessage: 'projects.en.gb.too.short')]
    private string $projectTitle = 'project_title';


    #[ORM\Column(name: 'project_s_desc', type: 'text', nullable: false, options: ['default' => 'project_s_desc'])]
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 50, minMessage: 'projects.en.gb.too.short')]
    private string $projectSDesc = 'project_s_desc';


    #[ORM\Column(name: 'project_desc', type: 'text', nullable: false, options: ['default' => 'project_desc'])]
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 100, minMessage: 'projects.en.gb.too.short')]
    private string $projectDesc = 'project_desc';


    #[ORM\Column(name: 'project_product_name', type: 'text', nullable: false, options: ['default' => 'project_product_name'])]
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 50, minMessage: 'projects.en.gb.too.short')]
    private string $projectProductName = 'project_product_name';


    #[ORM\Column(name: 'project_product_s_desc', type: 'text', nullable: false, options: ['default' => 'project_product_s_desc'])]
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'projects.en.gb.too.short')]
    private string $projectProductSDesc = 'project_product_s_desc';


    #[ORM\Column(name: 'project_product_desc', type: 'text', nullable: false, options: ['default' => 'project_product_desc'])]
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 100, minMessage: 'projects.en.gb.too.short')]
    private string $projectProductDesc = 'project_product_desc';

    #[ORM\OneToOne(inversedBy: 'projectEnGb', targetEntity: Project::class)]
    private Project $projectEnGb;


    #[Pure]
    public function __toString()
    {
        return $this->getProjectTitle();
    }

    public function getProjectTitle(): string
    {
        return $this->projectTitle;
    }

    /**
     * @return \App\Entity\Project\ProjectRuRu|\App\Entity\Project\ProjectEnGb|\App\Entity\Project\ProjectLanguageTrait|\App\Entity\Project\ProjectUkUa
     */
    public function setProjectTitle(string $projectTitle): self
    {
        $this->projectTitle = $projectTitle;
        return $this;
    }

    public function getProjectSDesc(): string
    {
        return $this->projectSDesc;
    }

    /**
     * @param string $projectSDesc
     * @return ProjectRuRu|ProjectEnGb|ProjectLanguageTrait|ProjectUkUa
     */
    public function setProjectSDesc(string $projectSDesc): self
    {
        $this->projectSDesc = $projectSDesc;
        return $this;
    }

    public function getProjectDesc(): string
    {
        return $this->projectDesc;
    }

    /**
     * @param string $projectDesc
     * @return ProjectRuRu|ProjectEnGb|ProjectLanguageTrait|ProjectUkUa
     */
    public function setProjectDesc(string $projectDesc): self
    {
        $this->projectDesc = $projectDesc;
        return $this;
    }

    public function getProjectProductName(): string
    {
        return $this->projectProductName;
    }

    /**
     * @param string $projectProductName
     * @return ProjectRuRu|ProjectEnGb|ProjectLanguageTrait|ProjectUkUa
     */
    public function setProjectProductName(string $projectProductName): self
    {
        $this->projectProductName = $projectProductName;
        return $this;
    }

    public function getProjectProductSDesc(): string
    {
        return $this->projectProductSDesc;
    }

    /**
     * @param string $projectProductSDesc
     * @return ProjectRuRu|ProjectEnGb|ProjectLanguageTrait|ProjectUkUa
     */
    public function setProjectProductSDesc(string $projectProductSDesc): self
    {
        $this->projectProductSDesc = $projectProductSDesc;
        return $this;
    }

    public function getProjectProductDesc(): string
    {
        return $this->projectProductDesc;
    }

    /**
     * @param string $projectProductDesc
     * @return ProjectRuRu|ProjectEnGb|ProjectLanguageTrait|ProjectUkUa
     */
    public function setProjectProductDesc(string $projectProductDesc): self
    {
        $this->projectProductDesc = $projectProductDesc;
        return $this;
    }

    public function getProjectEnGb(): Project
    {
        return $this->projectEnGb;
    }

    /**
     * @param $projectEnGb
     */
    public function setProjectEnGb($projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }

}

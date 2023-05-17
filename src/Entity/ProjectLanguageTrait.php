<?php

namespace App\Entity;

use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Project\ProjectEnGb;
use Symfony\Component\Serializer\Annotation\Ignore;
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
    #[Ignore]
    private Project $projectEnGb;

    public function getProjectTitle(): string
    {
        return $this->projectTitle;
    }

    /**
     * @return ProjectEnGb|ProjectLanguageTrait
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
     * @return ProjectEnGb|ProjectLanguageTrait
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
     * @return ProjectEnGb|ProjectLanguageTrait
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
     * @return ProjectEnGb|ProjectLanguageTrait
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
     * @return ProjectEnGb|ProjectLanguageTrait
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
     * @return ProjectEnGb|ProjectLanguageTrait
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

    public function setProjectEnGb($projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }
}

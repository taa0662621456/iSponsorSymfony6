<?php

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;

trait ProjectLanguageDTOTrait
{
    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 50, minMessage: 'projects.en.gb.too.short')]
    private string $projectTitle = 'project_title';

    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 50, minMessage: 'projects.en.gb.too.short')]
    private string $projectSDesc = 'project_s_desc';

    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 100, minMessage: 'projects.en.gb.too.short')]
    private string $projectDesc = 'project_desc';

    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 50, minMessage: 'projects.en.gb.too.short')]
    private string $projectProductName = 'project_product_name';

    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 10, minMessage: 'projects.en.gb.too.short')]
    private string $projectProductSDesc = 'project_product_s_desc';

    #[Assert\NotBlank(message: 'projects.en.gb.blank')]
    #[Assert\Length(min: 100, minMessage: 'projects.en.gb.too.short')]
    private string $projectProductDesc = 'project_product_desc';

    #[Ignore]
    private Project $projectEnGb;

//    #[Pure]
//    public function __toString()
//    {
//        return $this->getProjectTitle();
//    }

    public function getProjectTitle(): string
    {
        return $this->projectTitle;
    }

    /**
     * @return ProjectLanguageDTOTrait
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
     * @return ProjectLanguageDTOTrait
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
     * @return ProjectLanguageDTOTrait
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
     * @return ProjectLanguageDTOTrait
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
     * @return ProjectLanguageDTOTrait
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
     * @return ProjectLanguageDTOTrait
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

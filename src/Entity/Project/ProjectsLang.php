<?php
declare(strict_types=1);

namespace App\Entity\Project;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="projects_lang")
 * @ORM\Entity(repositoryClass="ProjectsEnGbRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource()
 */
class ProjectsLang
{
    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer", nullable=false, options={"comment"="Primary Key"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectId;

    /**
     * @var string
     *
     * @ORM\Column(name="project_title", type="string", nullable=false)
     */
    private $projectTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="project_s_desc", type="string", nullable=false)
     */
    private $projectSDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="project_desc", type="text", nullable=false)
     */
    private $projectDesc;


    /**
     * @var string
     *
     * @ORM\Column(name="project_product_name", type="string", nullable=false)
     */
    private $projectProductName;

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_s_desc", type="string", nullable=false)
     */
    private $projectProductSDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_desc", type="text", nullable=false)
     */
    private $projectProductDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_meta_desc", type="string", nullable=false)
     */
    private $projectProductMetaDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="project_product_meta_key", type="string", nullable=false)
     */
    private $projectProductMetaKey;

    /**
     * @var string
     *
     * @ORM\Column(name="project_slug", type="string", nullable=false)
     */
    private $projectSlug;

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return string
     */
    public function getProjectTitle(): ?string
    {
        return $this->projectTitle;
    }

    /**
     * @param string projectTitle
     * @return ProjectsLang
     */
    public function setProjectTitle(string $projectTitle): self
    {
        $this->projectTitle = $projectTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectSDesc(): ?string
    {
        return $this->projectSDesc;
    }

    /**
     * @param string projectSDesc
     * @return ProjectsLang
     */
    public function setProjectSDesc(string $projectSDesc): self
    {
        $this->projectSDesc = $projectSDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectDesc(): ?string
    {
        return $this->projectDesc;
    }

    /**
     * @param string projectDesc
     * @return ProjectsLang
     */
    public function setProjectDesc(string $projectDesc): self
    {
        $this->projectDesc = $projectDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductName(): ?string
    {
        return $this->projectProductName;
    }

    /**
     * @param string $projectProductName
     * @return ProjectsLang
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
     * @return ProjectsLang
     */
    public function setProjectProductSDesc(string $projectProductSDesc): self
    {
        $this->projectProductSDesc = $projectProductSDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductDesc(): ?string
    {
        return $this->projectProductDesc;
    }

    /**
     * @param string $projectProductDesc
     * @return ProjectsLang
     */
    public function setProjectProductDesc(string $projectProductDesc): self
    {
        $this->projectProductDesc = $projectProductDesc;
        return $this;
    }


    /**
     * @return string
     */
    public function getProjectProductMetaDesc(): ?string
    {
        return $this->projectProductMetaDesc;
    }

    /**
     * @param string $projectProductMetaDesc
     * @return ProjectsLang
     */
    public function setProjectProductMetaDesc(string $projectProductMetaDesc): self
    {
        $this->projectProductMetaDesc = $projectProductMetaDesc;
        return $this;
    }

    /**
     * @return string
     */
    public function getProjectProductMetaKey(): ?string
    {
        return $this->projectProductMetaKey;
    }

    /**
     * @param string $projectProductMetaKey
     * @return ProjectsLang
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
     * @return ProjectsLang
     */
    public function setProjectSlug(string $projectSlug): self
    {
        $this->projectSlug = $projectSlug;
        return $this;
    }



}
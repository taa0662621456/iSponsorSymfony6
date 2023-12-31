<?php

namespace App\Entity\Category;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Repository\Category\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectInterface;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Featured\FeaturedInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\EntityInterface\Category\CategoryAttachmentInterface;

#[ORM\Entity]
class Category extends RootEntity implements ObjectInterface, ObjectApiResourceInterface, CategoryInterface
{
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ordering', type: 'integer', unique: false, nullable: false, options: ['default' => 1])]
    private int $ordering = 1;

    #[ORM\OneToMany(mappedBy: 'categoryParent', targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryChildren;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, cascade: ['persist'], inversedBy: 'categoryChildren')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CategoryInterface $categoryParent = null;

    #[ORM\OneToMany(mappedBy: 'projectCategory', targetEntity: ProjectInterface::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryProject;

    #[ORM\OneToOne(mappedBy: 'categoryEnGb', targetEntity: CategoryEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private CategoryEnGb $categoryEnGb;

    #[ORM\OneToMany(mappedBy: 'categoryAttachmentCategory', targetEntity: CategoryAttachmentInterface::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryAttachment;

    #[ORM\OneToOne(mappedBy: 'categoryFeatured', targetEntity: FeaturedInterface::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Featured $categoryFeatured;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->categoryChildren = new ArrayCollection();
        $this->categoryProject = new ArrayCollection();
        $this->categoryAttachment = new ArrayCollection();
    }

    public function getOrdering(): int
    {
        return $this->ordering;
    }

    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    public function getCategoryChildren(): Collection
    {
        return $this->categoryChildren;
    }

    public function setCategoryChildren(?CategoryInterface $categoryChildren): void
    {
        $this->categoryChildren = $categoryChildren;
    }

    public function getCategoryParent(): ?CategoryInterface
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(Collection $categoryParent): void
    {
        $this->categoryParent = $categoryParent;
    }

    public function getCategoryProject(): Collection
    {
        return $this->categoryProject;
    }

    public function getCategoryEnGb(): CategoryEnGb
    {
        return $this->categoryEnGb;
    }

    public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void
    {
        $this->categoryEnGb = $categoryEnGb;
    }

    public function getCategoryAttachment(): Collection
    {
        return $this->categoryAttachment;
    }

    public function setCategoryAttachment(Collection $categoryAttachment): void
    {
        $this->categoryAttachment = $categoryAttachment;
    }

    public function getCategoryFeatured(): Featured
    {
        return $this->categoryFeatured;
    }

    public function setCategoryFeatured(Featured $categoryFeatured): void
    {
        $this->categoryFeatured = $categoryFeatured;
    }

    public function addCategoryProject(ProjectInterface $project): void
    {
        if (!$this->categoryProject->contains($project)) {
            $this->categoryProject->add($project);

            $project->setProjectCategory($this);
        }
    }

    public function removeCategoryProject(ProjectInterface $project): void
    {
        if ($this->categoryProject->contains($project)) {
            $this->categoryProject->removeElement($project);
            if ($project->getProjectCategory() === $this) {
                $project->setProjectCategory(null);
            }
        }
    }

}

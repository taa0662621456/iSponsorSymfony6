<?php

namespace App\Entity\Category;

use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Interface\Category\CategoryInterface;
use App\Interface\Featured\FeaturedInterface;
use Doctrine\Common\Collections\ArrayCollection;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Category\CategoryAttachmentInterface;

#[ORM\Entity]
final class Category extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, CategoryInterface
{
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ordering', type: 'integer', unique: false, nullable: false, options: ['default' => 1])]
    private int $ordering = 1;

    #[ORM\OneToMany(mappedBy: 'categoryParent', targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryChildren;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, cascade: ['persist'], inversedBy: 'categoryChildren')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryParent;

    #[ORM\OneToMany(mappedBy: 'projectCategory', targetEntity: ProjectInterface::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryProject;

    #[ORM\OneToOne(mappedBy: 'categoryEnGbCategory', targetEntity: CategoryEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
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
        $t = new \DateTime();
        $this->categoryChildren = new ArrayCollection();
        $this->categoryProject = new ArrayCollection();
        $this->categoryAttachment = new ArrayCollection();
    }

    // OneToMany
    public function getCategoryProject(): Collection
    {
        return $this->categoryProject;
    }

    public function setCategoryProject(Project $categoryProject): void
    {
        $this->categoryProject = $categoryProject;
    }

    // OneToOne
    public function getCategoryEnGb(): CategoryEnGb
    {
        return $this->categoryEnGb;
    }

    public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void
    {
        $this->categoryEnGb = $categoryEnGb;
    }

    public function getOrdering(): int
    {
        return $this->ordering;
    }

    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    // OneToMany
    public function getCategoryChildren(): Collection
    {
        return $this->categoryChildren;
    }

    public function addCategoryChildren(self $categoryChildren): self
    {
        if (!$this->categoryChildren->contains($categoryChildren)) {
            $this->categoryChildren[] = $categoryChildren;
        }

        return $this;
    }

    public function removeCategoryChildren(self $categoryChildren): self
    {
        if ($this->categoryChildren->contains($categoryChildren)) {
            $this->categoryChildren->removeElement($categoryChildren);
        }

        return $this;
    }

    // ManyToOne
    public function getCategoryParent(): self
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(self $categoryParent): void
    {
        $this->categoryParent = $categoryParent;
    }

    // OneToMany
    public function getCategoryAttachment(): Collection
    {
        return $this->categoryAttachment;
    }

    public function addCategoryAttachment(CategoryAttachment $categoryAttachment): self
    {
        if (!$this->categoryAttachment->contains($categoryAttachment)) {
            $this->categoryAttachment[] = $categoryAttachment;
        }

        return $this;
    }

    public function removeCategoryAttachment(CategoryAttachment $categoryAttachment): self
    {
        if ($this->categoryAttachment->contains($categoryAttachment)) {
            $this->categoryAttachment->removeElement($categoryAttachment);
        }

        return $this;
    }

    // OneToOne
    public function getCategoryFeatured(): Featured
    {
        return $this->categoryFeatured;
    }

    public function setCategoryFeatured(Featured $categoryFeatured): void
    {
        $this->categoryFeatured = $categoryFeatured;
    }
}

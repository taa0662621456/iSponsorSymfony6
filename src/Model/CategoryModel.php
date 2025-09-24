<?php


namespace App\Model;

use App\Entity\ObjectBaseTrait;
use App\Entity\Category\CategoryEnGb;
use App\Entity\Featured\Featured;
use App\Entity\ObjectTitleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * @property int $id
 */
class CategoryModel
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

    private int $ordering = 1;

    private Collection $children;

    private ArrayCollection $parent;

    private Collection $categoryProjects;

    private CategoryEnGb $categoryEnGb;

    private Collection $categoryAttachments;

    private Featured $categoryFeatured;

    public function __construct(int $id, string $firstTitle, string $lastTitle)
    {
        $this->id = $id;
        $this->firstTitle = $firstTitle;
        $this->lastTitle = $lastTitle;

        $this->children = new ArrayCollection();
        $this->categoryProjects = new ArrayCollection();
        $this->categoryAttachments = new ArrayCollection();
    }
    public function getCategoryProjects(): ArrayCollection
    {
        return $this->categoryProjects;
    }

    public function getCategoryEnGb(): CategoryEnGb
    {
        return $this->categoryEnGb;
    }

    public function getOrdering(): int
    {
        return $this->ordering;
    }

    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }
    public function getParent(): ArrayCollection
    {
        return $this->parent;
    }

    public function getCategoryAttachments(): ArrayCollection
    {
        return $this->categoryAttachments;
    }
    public function getCategoryFeatured(): Featured
    {
        return $this->categoryFeatured;
    }
}
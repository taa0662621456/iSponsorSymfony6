<?php
namespace App\Interface;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Category\CategoryEnGb;
use App\Entity\Featured\Featured;
use Doctrine\Common\Collections\ArrayCollection;

interface CategoryInterface
{
    public function getCategoryProjects(): ArrayCollection;

    public function addCategoryProjects(ArrayCollection $categoryProjects): void;

    public function getCategoryEnGb(): CategoryEnGb;

	public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void;

	public function getOrdering(): int;

	public function setOrdering(int $ordering): void;

	public function addChildren($children):Category;

    public function removeChildren(Category $children): void;

    public function getChildren(): ArrayCollection;

    public function getParent(): ArrayCollection|Category;

	public function addParent(Category $parent): void;

	public function addCategoryAttachment(CategoryAttachment $attachments): void;

	public function removeCategoryAttachment(CategoryAttachment $attachment): void;

    public function getCategoryAttachments(): ArrayCollection|CategoryAttachment;

    public function getCategoryFeatured(): Featured;

	public function addCategoryFeatured(Featured $categoryFeatured): void;
}

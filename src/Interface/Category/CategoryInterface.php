<?php
namespace App\Interface\Category;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Category\CategoryEnGb;
use App\Entity\Featured\Featured;
use App\Entity\Project\Project;
use Doctrine\Common\Collections\Collection;

interface CategoryInterface
{
    # ManyToOne
    public function getCategoryProject(): Collection;
    public function setCategoryProject(Project $categoryProject): void;
    # OneToOne
    public function getCategoryEnGb(): CategoryEnGb;
	public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void;
    #
	public function getOrdering(): int;
	public function setOrdering(int $ordering): void;
    # OneToMany
    public function getCategoryChildren(): Collection;
    public function addCategoryChildren(Category $categoryChildren): self;
    public function removeCategoryChildren(Category $categoryChildren): self;
    # ManyToOne
    public function getCategoryParent(): Category;
	public function setCategoryParent(Category $categoryParent): void;
    # OneToMany
    public function getCategoryAttachment(): Collection;
    public function addCategoryAttachment(CategoryAttachment $categoryAttachment): self;
    public function removeCategoryAttachment(CategoryAttachment $categoryAttachment): self;
    # OneToOne
    public function getCategoryFeatured(): Featured;
    public function setCategoryFeatured(Featured $categoryFeatured): void;
    #

}

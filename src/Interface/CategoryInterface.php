<?php
namespace App\Interface;

use App\Entity\Category\Category;
use App\Entity\Category\CategoryAttachment;
use App\Entity\Category\CategoryEnGb;
use App\Entity\Featured\Featured;
use Doctrine\Common\Collections\ArrayCollection;

interface CategoryInterface
{
    /**
     * @return ArrayCollection
     */
	public function getCategoryProjects(): ArrayCollection;

    /**
     * @param ArrayCollection $categoryProjects
     * @return void
     */
	public function setCategoryProjects(ArrayCollection $categoryProjects): void;

    /**
     * @return CategoryEnGb
     */
    public function getCategoryEnGb(): CategoryEnGb;

	/**
	 * @param CategoryEnGb $categoryEnGb
	 * @return void
	 */
	public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void;

	/**
	 * @return int
	 */
	public function getOrdering(): int;

	/**
	 * @param int $ordering
     * @return void
	 */
	public function setOrdering(int $ordering): void;

    /**
     * @param $children
     * @return Category
     */
	public function addChildren($children):Category;

    /**
     * @param Category $children
     * @return void
     */
	public function removeChildren(Category $children): void;

    /**
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection;

    /**
     * @return Category|null
     * @return void
     */
	public function getParent(): Category|null;

	/**
	 * @param Category $parent
	 * @return Category
	 */
	public function setParent(Category $parent): Category;

	/**
	 * @param CategoryAttachment $attachments
	 */
	public function addCategoryAttachment(CategoryAttachment $attachments): void;

	/**
	 * @param CategoryAttachment $attachment
	 */
	public function removeCategoryAttachment(CategoryAttachment $attachment): void;

    /**
     * @return ArrayCollection
     */
	public function getCategoryAttachments(): ArrayCollection;

    /**
     * @return Featured
     */
	public function getCategoryFeatured(): Featured;

	/**
	 * @param $categoryFeatured
     * @return void
	 */
	public function setCategoryFeatured($categoryFeatured): void;



}

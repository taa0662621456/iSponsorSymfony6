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
	public function addCategoryProjects(ArrayCollection $categoryProjects): void;

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
     * @return ArrayCollection|Category
     */
	public function getParent(): ArrayCollection|Category;

	/**
	 * @param Category $parent
	 */
	public function addParent(Category $parent): void;

	/**
	 * @param CategoryAttachment $attachments
	 */
	public function addCategoryAttachment(CategoryAttachment $attachments): void;

	/**
	 * @param CategoryAttachment $attachment
	 */
	public function removeCategoryAttachment(CategoryAttachment $attachment): void;

    /**
     * @return ArrayCollection|CategoryAttachment
     */
	public function getCategoryAttachments(): ArrayCollection|CategoryAttachment;

    /**
     * @return ArrayCollection|Featured
     */
	public function getCategoryFeatured(): Featured|ArrayCollection;

	/**
	 * @param $categoryFeatured
     * @return void
	 */
	public function addCategoryFeatured($categoryFeatured): void;



}

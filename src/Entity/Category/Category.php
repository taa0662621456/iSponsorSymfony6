<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use JetBrains\PhpStorm\Pure;



/**
 * @ORM\Table(name="categories", indexes={
 * @ORM\Index(name="category_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category
{
	use BaseTrait;

	/**
	 * @var int
	 *
	 * @ORM\GeneratedValue()
	 * @ORM\Column(name="ordering", type="integer", nullable=false, unique=false, options={"default" : 1})
	 */
	private int $ordering = 1;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Category\Category",
	 *     mappedBy="parent",
	 *     fetch="EXTRA_LAZY")
	 */
	private ArrayCollection $children;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category\Category",
	 *     cascade={"persist"},
	 *     inversedBy="children")
	 */
    private Category $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project\Project",
	 *      mappedBy="projectCategory")
     */
    private ArrayCollection $categoryProjects;

    /**
	 * @ORM\OneToOne(targetEntity="App\Entity\Category\CategoryEnGb",
	 *     cascade={"persist", "remove"},
	 *     mappedBy="categoryEnGb",
	 *     orphanRemoval=true)
	 * @ORM\JoinColumn(name="categoryEnGb_id", referencedColumnName="id", onDelete="CASCADE")
	 * @Assert\Type(type="App\Entity\Category\CategoryEnGb")
	 * @Assert\Valid()
	 */
	private CategoryEnGb $categoryEnGb;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Category\CategoryAttachment",
	 *     mappedBy="categoryAttachments",
	 *     cascade={"persist", "remove"},
	 *     orphanRemoval=true)
	 */
	private ArrayCollection $categoryAttachments;

	/**
	 * @ORM\OneToOne(targetEntity="App\Entity\Featured\Featured", mappedBy="categoryFeatured")
	 */
	private Featured $categoryFeatured;


	/**
	 * @throws Exception
	 */
	#[Pure]
    public function __construct()
	{
		$this->children = new ArrayCollection();
		$this->categoryProjects = new ArrayCollection();
		$this->categoryAttachments = new ArrayCollection();
	}

	/**
	 * @return ArrayCollection
	 */
	public function getCategoryProjects(): ArrayCollection
	{
		return $this->categoryProjects;
	}

	/**
	 * @param ArrayCollection $categoryProjects
	 */
	public function setCategoryProjects(ArrayCollection $categoryProjects): void
	{
		$this->categoryProjects = $categoryProjects;
	}


    /**
     * @return CategoryEnGb
     */
    public function getCategoryEnGb(): CategoryEnGb
    {
        return $this->categoryEnGb;
    }

	/**
	 * @param CategoryEnGb $categoryEnGb
	 */
	public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void
	{
		$this->categoryEnGb = $categoryEnGb;
	}

	/**
	 * @return int
	 */
	public function getOrdering(): int
	{
		return $this->ordering;
	}

	/**
	 * @param int $ordering
	 */
	public function setOrdering(int $ordering): void
	{
		$this->ordering = $ordering;
	}


    /**
     * @param $children
     * @return Category
     */
	public function addChildren($children):Category
    {
		$this->children = $children;

		return $this;
	}

    /**
     * @param Category $children
     */
	public function removeChildren(Category $children): void
	{
		$this->children->removeElement($children);
	}

    /**
     * @return ArrayCollection
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    /**
     * @return Category|null
     */
	public function getParent(): ?Category
    {
		return $this->parent;
	}

	/**
	 * @param Category $parent
	 *
	 * @return Category
	 */
	public function setParent(Category $parent): Category
	{
		$this->parent = $parent;

		return $this;
	}


	/**
	 * @param CategoryAttachment $attachments
	 */
	public function addCategoryAttachment(CategoryAttachment $attachments): void
	{
		foreach ($attachments as $attachment) {
			if (!$this->categoryAttachments->contains($attachment)) {
				$this->categoryAttachments->add($attachment);
			}
		}
	}


	/**
	 * @param CategoryAttachment $attachment
	 */
	public function removeCategoryAttachment(CategoryAttachment $attachment): void
	{
		$this->categoryAttachments->removeElement($attachment);
	}

    /**
     * @return ArrayCollection
     */
	public function getCategoryAttachments(): ArrayCollection
	{
		return $this->categoryAttachments;
	}

    /**
     * @return Featured
     */
	public function getCategoryFeatured(): Featured
    {
		return $this->categoryFeatured;
	}

	/**
	 * @param $categoryFeatured
	 */
	public function setCategoryFeatured($categoryFeatured): void
	{
		$this->categoryFeatured = $categoryFeatured;
	}


}

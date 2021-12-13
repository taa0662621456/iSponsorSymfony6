<?php
declare(strict_types=1);

namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Interface\CategoryInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use JetBrains\PhpStorm\Pure;



/**
 * @ORM\Table(name="categories", indexes={
 * @ORM\Index(name="category_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Category implements CategoryInterface
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
     * @ORM\OneToMany(targetEntity="App\Interface\CategoryInterface",
     *     mappedBy="parent",
     *     fetch="EXTRA_LAZY")
     */
    private ArrayCollection $children;

    /**
     * @ORM\ManyToOne(targetEntity="App\Interface\CategoryInterface",
     *     cascade={"persist"},
     *     inversedBy="children")
     */
    private ArrayCollection $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Interface\ProjectInterface",
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
     * @ORM\OneToMany(targetEntity="App\Interface\CategoryAttachmentInterface",
     *     mappedBy="categoryAttachments",
     *     cascade={"persist", "remove"},
     *     orphanRemoval=true)
     */
    private ArrayCollection $categoryAttachments;

    /**
     * @ORM\OneToOne(targetEntity="App\Interface\FeaturedInterface",
     *     mappedBy="categoryFeatured")
     */
    private ArrayCollection $categoryFeatured;


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
    public function addCategoryProjects(ArrayCollection $categoryProjects): void
    {
        $this->categoryProjects->add($categoryProjects);
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
     * @param CategoryInterface $children
     */
    public function removeChildren(CategoryInterface $children): void
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
     * @return ArrayCollection
     */
    public function getParent(): ArrayCollection
    {
        return $this->parent;
    }

    /**
     * @param $parent
     *
     */
    public function addParent($parent):void
    {
        $this->parent->add($parent);

    }


    /**
     * @param $attachments
     */
    public function addCategoryAttachment($attachments): void
    {
        foreach ($attachments as $attachment) {
            if (!$this->categoryAttachments->contains($attachment)) {
                $this->categoryAttachments->add($attachment);
            }
        }
    }


    /**
     * @param $attachment
     */
    public function removeCategoryAttachment($attachment): void
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
     * @return ArrayCollection
     */
    public function getCategoryFeatured(): ArrayCollection
    {
        return $this->categoryFeatured;
    }

    /**
     * @param $categoryFeatured
     */
    public function addCategoryFeatured($categoryFeatured): void
    {
        $this->categoryFeatured->add($categoryFeatured);
    }
}

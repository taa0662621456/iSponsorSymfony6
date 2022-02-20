<?php


namespace App\Entity\Category;

use App\Entity\BaseTrait;
use App\Interface\CategoryAttachmentInterface;
use App\Interface\CategoryInterface;
use App\Interface\FeaturedInterface;
use App\Interface\ProjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use JetBrains\PhpStorm\Pure;



#[ORM\Table(name: 'categories')]
#[ORM\Index(columns: ['slug'], name: 'category_idx')]
#[ORM\Entity(repositoryClass: \App\Repository\Category\CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Category implements CategoryInterface
{
    use BaseTrait;

    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ordering', type: 'integer', unique: false, nullable: false, options: ['default' => 1])]
    private int $ordering = 1;
    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY')]
    private ArrayCollection $children;
    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, cascade: ['persist'], inversedBy: 'children')]
    private ArrayCollection $parent;
    #[ORM\OneToMany(mappedBy: 'projectCategory', targetEntity: ProjectInterface::class)]
    private ArrayCollection $categoryProjects;
    #[ORM\OneToOne(mappedBy: 'categoryEnGb', targetEntity: CategoryEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'categoryEnGb_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[Assert\Type(type: CategoryEnGb::class)]
    #[Assert\Valid]
    private CategoryEnGb $categoryEnGb;
    #[ORM\OneToMany(mappedBy: 'categoryAttachments', targetEntity: CategoryAttachmentInterface::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private ArrayCollection $categoryAttachments;
    #[ORM\OneToOne(mappedBy: 'categoryFeatured', targetEntity: FeaturedInterface::class)]
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
    public function getCategoryProjects(): ArrayCollection
    {
        return $this->categoryProjects;
    }
    public function addCategoryProjects(ArrayCollection $categoryProjects): void
    {
        $this->categoryProjects->add($categoryProjects);
    }
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

    /**
     * @param $children
     * @return Category
     */
    public function addChildren($children):Category
    {
        $this->children = $children;

        return $this;
    }
    public function removeChildren(CategoryInterface $children): void
    {
        $this->children->removeElement($children);
    }
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }
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
    public function getCategoryAttachments(): ArrayCollection
    {
        return $this->categoryAttachments;
    }
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

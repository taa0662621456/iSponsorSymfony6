<?php


namespace App\Entity\Category;

use App\Entity\Attachment\Attachment;
use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\Project\Project;
use App\Interface\CategoryAttachmentInterface;
use App\Interface\CategoryInterface;
use App\Interface\FeaturedInterface;
use App\Interface\ProjectInterface;
use App\Repository\Category\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use JetBrains\PhpStorm\Pure;
use DateTime;


#[ORM\Table(name: 'category')]
#[ORM\Index(columns: ['slug'], name: 'category_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Category implements CategoryInterface
{
    use BaseTrait;
    use ObjectTrait;
    use MetaTrait;


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
    #[Assert\Type(type: CategoryEnGb::class)]
    #[Assert\Valid]
    #[Ignore]
    private CategoryEnGb $categoryEnGb;

    #[ORM\OneToMany(mappedBy: 'categoryAttachmentCategory', targetEntity: CategoryAttachmentInterface::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryAttachment;

    #[ORM\OneToOne(mappedBy: 'categoryFeatured', targetEntity: FeaturedInterface::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\Type(type: CategoryFeatured::class)]
    #[Assert\Valid]
    #[Ignore]
    private Featured $categoryFeatured;

    /**
     * @throws Exception
     */
    #[Pure]
    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();
        $this->categoryChildren = new ArrayCollection();
        $this->categoryProject = new ArrayCollection();
        $this->categoryAttachment = new ArrayCollection();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
    # OneToMany
    public function getCategoryProject(): Collection
    {
        return $this->categoryProject;
    }
    public function setCategoryProject(Project $categoryProject): void
    {
            $this->categoryProject = $categoryProject;
    }
    # OneToOne
    public function getCategoryEnGb(): CategoryEnGb
    {
        return $this->categoryEnGb;
    }
    public function setCategoryEnGb(CategoryEnGb $categoryEnGb): void
    {
        $this->categoryEnGb = $categoryEnGb;
    }
    #
    public function getOrdering(): int
    {
        return $this->ordering;
    }
    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }
    # OneToMany
    public function getCategoryChildren(): Collection
    {
        return $this->categoryChildren;
    }
    public function addCategoryChildren(Category $categoryChildren): self
    {
        if (!$this->categoryChildren->contains($categoryChildren)) {
            $this->categoryChildren[] = $categoryChildren;
        }
        return $this;
    }
    public function removeCategoryChildren(Category $categoryChildren): self
    {
        if ($this->categoryChildren->contains($categoryChildren)){
            $this->categoryChildren->removeElement($categoryChildren);
        }
        return $this;
    }
    # ManyToOne
    public function getCategoryParent(): Category
    {
        return $this->categoryParent;
    }
    public function setCategoryParent(Category $categoryParent):void
    {
        $this->categoryParent = $categoryParent;
    }
    # OneToMany
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
        if ($this->categoryAttachment->contains($categoryAttachment)){
            $this->categoryAttachment->removeElement($categoryAttachment);
        }
        return $this;
    }
    # OneToOne
    public function getCategoryFeatured(): Featured
    {
        return $this->categoryFeatured;
    }
    public function setCategoryFeatured(Featured $categoryFeatured): void
    {
        $this->categoryFeatured = $categoryFeatured;
    }
}

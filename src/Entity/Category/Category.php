<?php


namespace App\Entity\Category;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\CurrencyFilterTrait;
use App\Api\Filter\SlugTitleFilterTrait;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\CategoryLanguageTrait;
use App\Entity\Featured\Featured;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\Project\Project;
use App\Interface\Category\CategoryInterface;
use App\Interface\Featured\FeaturedInterface;
use App\Interface\Project\ProjectInterface;
use App\Repository\Category\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use JetBrains\PhpStorm\Pure;
use DateTime;


#[ORM\Table(name: 'category')]
#[ORM\Index(columns: ['slug'], name: 'category_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class Category implements CategoryInterface
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    use MetaTrait;
    # API Filters
    use TimestampFilterTrait;
    use SlugTitleFilterTrait;
    use StatusFilterTrait;

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
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();
        $this->categoryChildren = new ArrayCollection();
        $this->categoryProject = new ArrayCollection();
        $this->categoryAttachment = new ArrayCollection();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
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

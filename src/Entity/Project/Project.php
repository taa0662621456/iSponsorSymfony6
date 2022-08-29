<?php

namespace App\Entity\Project;

use App\Entity\Attachment\Attachment;
use App\Entity\BaseTrait;
use App\Entity\Category\Category;
use App\Entity\Featured\Featured;
use App\Entity\ObjectTrait;
use App\Entity\Product\Product;
use App\Entity\Project\ProjectType;
use App\Entity\Tag\Tag;
use App\Interface\CategoryInterface;
use App\Interface\ProjectInterface;
use App\Interface\ProjectTypeInterface;
use App\Repository\Project\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use JetBrains\PhpStorm\Pure;
use phpDocumentor\Reflection\Types\Self_;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'project')]
#[ORM\Index(columns: ['slug'], name: 'project_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Project implements ProjectInterface
{
    use BaseTrait;
    use ObjectTrait;

    public const NUM_ITEMS = 10;

    #[ORM\ManyToOne(targetEntity: ProjectTypeInterface::class, inversedBy: 'projectType')]
    #[Assert\Type(type: 'App\Entity\Project\ProjectType')]
    #[Assert\Valid]
    private ProjectType $projectType;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY', inversedBy: 'categoryProject')]
    #[Assert\Valid]
    private Category $projectCategory;

    #[ORM\OneToOne(mappedBy: 'projectEnGb', targetEntity: ProjectEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Project\ProjectEnGb')]
    #[Assert\Valid]
    private ProjectEnGb $projectEnGb;

    #[ORM\OneToMany(mappedBy: 'projectAttachmentProject', targetEntity: ProjectAttachment::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    #[Assert\Count(max: 8, maxMessage: 'project.too_many_files')]
    #[Assert\Valid]
    private Collection $projectAttachment;

    #[ORM\ManyToMany(targetEntity: ProjectFavourite::class, mappedBy: 'projectFavourite')]
    private Collection $projectFavourite;

    #[ORM\OneToOne(mappedBy: 'projectFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Project\projectFeatured')]
    #[Assert\Valid]
    private Featured $projectFeatured;

    #[ORM\ManyToMany(targetEntity: ProjectTag::class, cascade: ['persist'], inversedBy: 'projectTagProject')]
    #[ORM\JoinColumn(nullable: true)]
    #[ORM\OrderBy(['firstTitle' => 'ASC'])]
    #[Assert\Count(max: 4, maxMessage: 'project.too_many_tags')]
    private Collection $projectTag;

    #[ORM\OneToMany(mappedBy: 'productProject', targetEntity: Product::class, cascade: ['persist'], orphanRemoval: true)]
    #[Assert\Count(max: 100, maxMessage: 'project.too_many_files')]
    private Collection $projectProduct;

    #[ORM\OneToMany(mappedBy: 'projectId', targetEntity: ProjectPlatformReward::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    #[Assert\Count(max: 100, maxMessage: 'project.too_many_rewards')]
    private Collection $projectPlatformReward;

    #[Pure]
    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();
        $this->projectAttachment = new ArrayCollection();
        $this->projectTag = new ArrayCollection();
        $this->projectProduct = new ArrayCollection();
        $this->projectPlatformReward = new ArrayCollection();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }



    # ManyToOne
    public function getProjectCategory():Collection
    {
        return $this->projectCategory;
    }
    public function setProjectCategory(Category $projectCategory): void
    {
        $this->projectCategory = $projectCategory;
    }
    # ManyToOne
    public function getProjectType(): Collection
    {
        return $this->projectType;
    }
    public function setProjectType(ProjectType $projectType): void
    {
        $this->projectType = $projectType;
    }
    # ManyToMany
    public function getProjectTag(): Collection
    {
        return $this->projectTag;
    }
    public function addProjectTag(ProjectTag $projectTag): void
    {
        $projectTag->addProjectTag($this);
        $this->projectTag[] = $projectTag;
    }
    public function removeProjectTag(ProjectTag $projectTag): self
    {
        if ($this->projectTag->contains($projectTag)){
            $this->projectTag->removeElement($projectTag);
        }
        return $this;
    }
    # OneToMany
    public function getProjectAttachment(): Collection
    {
        return $this->projectAttachment;
    }
    public function addProjectAttachment(ProjectAttachment $attachment): self
    {
        if (!$this->projectAttachment->contains($attachment)) {
            $this->projectAttachment[] = $attachment;
        }
        return $this;
    }
    public function removeProjectAttachment(ProjectAttachment $projectAttachmenat): self
    {
        $this->projectAttachment->removeElement($projectAttachmenat);
    }
    # OneToMany
    public function getProjectProduct(): Collection
    {
        return $this->projectProduct;
    }
    public function addProjectProduct(Product $projectProduct): self
    {
        if (!$this->projectProduct->contains($projectProduct)) {
            $this->projectProduct[] = $projectProduct;
        }
        return $this;
    }
    public function removeProjectProduct(Product $projectProduct): self
    {
        if ($this->projectProduct->contains($projectProduct)) {
            $this->projectProduct->removeElement($projectProduct);
        }
        return $this;
    }
    # OneToMany
    public function getProjectPlatformReward(): Collection
    {
        return $this->projectPlatformReward;
    }
    public function addProjectPlatformReward(ProjectPlatformReward $projectPlatformReward): self
    {
        if (!$this->projectPlatformReward->contains($projectPlatformReward)) {
            $this->projectPlatformReward[] = $projectPlatformReward;
        }
        return $this;
    }
    public function removeProjectPlatformReward(ProjectPlatformReward $projectPlatformReward): self
    {
        if ($this->projectPlatformReward->contains($projectPlatformReward)){
            $this->projectPlatformReward->removeElement($projectPlatformReward);
        }
        return $this;
    }
    # OneToOne
    public function getProjectEnGb(): ProjectEnGb
    {
        return $this->projectEnGb;
    }
    public function setProjectEnGb(ProjectEnGb $projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }
    # ManyToMany
    public function getProjectFavourite(): Collection
    {
        return $this->projectFavourite;
    }
    public function addProjectFavorite(ProjectFavourite $projectFavourite): self
    {
        if (!$this->projectFavourite->contains($projectFavourite)) {
            $this->projectFavourite[] = $projectFavourite;
        }
        return $this;
    }
    public function removeProjectFavourite(ProjectFavourite $projectFavourite): self
    {
        if ($this->projectFavourite->contains($projectFavourite)) {
            $this->projectFavourite->remove($projectFavourite);
        }
        return $this;
    }
    # OneToOne
    public function getProjectFeatured(): Featured
    {
        return $this->projectFeatured;
    }
    public function setProjectFeatured(Featured $projectFeatured): void
    {
        $this->projectFeatured = $projectFeatured;
    }

}

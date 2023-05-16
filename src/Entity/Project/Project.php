<?php

namespace App\Entity\Project;

use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category\Category;
use App\Entity\Featured\Featured;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Project\ProjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Interface\Category\CategoryInterface;
use App\Interface\Project\ProjectTypeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
final class Project extends ObjectSuperEntity implements ObjectInterface, ProjectInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\ManyToOne(targetEntity: ProjectTypeInterface::class, inversedBy: 'projectTypeProject')]
    #[Assert\Type(type: 'App\Entity\Project\ProjectType')]
    private ProjectType $projectType;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY', inversedBy: 'categoryProject')]
    private Category $projectCategory;

    #[ORM\OneToOne(mappedBy: 'projectEnGb', targetEntity: ProjectEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ProjectEnGb $projectEnGb;

    #[ORM\OneToMany(mappedBy: 'projectAttachmentProject', targetEntity: ProjectAttachment::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $projectAttachment;

    #[ORM\ManyToMany(targetEntity: ProjectFavourite::class, mappedBy: 'projectFavourite')]
    private Collection $projectFavourite;

    #[ORM\OneToOne(mappedBy: 'projectFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Featured $projectFeatured;

    #[ORM\ManyToMany(targetEntity: ProjectTag::class, inversedBy: 'projectTagProject', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: true)]
    #[ORM\OrderBy(['firstTitle' => 'ASC'])]
    private Collection $projectTag;

    #[ORM\OneToMany(mappedBy: 'productProject', targetEntity: Product::class, cascade: ['persist'], orphanRemoval: true)]
    #[Assert\Count(max: 100, maxMessage: 'project.too_many_files')]
    private Collection $projectProduct;

    #[ORM\OneToMany(mappedBy: 'projectId', targetEntity: ProjectPlatformReward::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $projectPlatformReward;

    #[ORM\OneToMany(mappedBy: 'projectReviewProject', targetEntity: ProjectReview::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $projectReview;

    public function __construct()
    {
        $t = new \DateTime();

        $this->projectAttachment = new ArrayCollection();
        $this->projectTag = new ArrayCollection();
        $this->projectProduct = new ArrayCollection();
        $this->projectPlatformReward = new ArrayCollection();
        $this->projectReview = new ArrayCollection();
    }

    // ManyToOne
    public function getProjectCategory(): Category
    {
        return $this->projectCategory;
    }

    public function setProjectCategory(Category $projectCategory): void
    {
        $this->projectCategory = $projectCategory;
    }

    // ManyToOne
    public function getProjectType(): ProjectType
    {
        return $this->projectType;
    }

    public function setProjectType(ProjectType $projectType): void
    {
        $this->projectType = $projectType;
    }

    // ManyToMany
    public function getProjectTag(): Collection
    {
        return $this->projectTag;
    }

    public function addProjectTag(ProjectTag $projectTag): self
    {
        if (!$this->projectTag->contains($projectTag)) {
            $this->projectTag[] = $projectTag;
        }

        return $this;
    }

    public function removeProjectTag(ProjectTag $projectTag): self
    {
        if ($this->projectTag->contains($projectTag)) {
            $this->projectTag->removeElement($projectTag);
        }

        return $this;
    }

    // OneToMany
    public function getProjectAttachment(): Collection
    {
        return $this->projectAttachment;
    }

    public function addProjectAttachment(ProjectAttachment $projectAttachment): self
    {
        if (!$this->projectAttachment->contains($projectAttachment)) {
            $this->projectAttachment[] = $projectAttachment;
        }

        return $this;
    }

    public function removeProjectAttachment(ProjectAttachment $projectAttachment): self
    {
        if ($this->projectAttachment->contains($projectAttachment)) {
            $this->projectAttachment->removeElement($projectAttachment);
        }

        return $this;
    }

    // OneToMany
    public function getProjectProduct(): Collection
    {
        return $this->projectProduct;
    }

    public function addProjectProduct(Product $product): self
    {
        if (!$this->projectProduct->contains($product)) {
            $this->projectProduct[] = $product;
        }

        return $this;
    }

    public function removeProjectProduct(Product $product): self
    {
        if ($this->projectProduct->contains($product)) {
            $this->projectProduct->removeElement($product);
        }

        return $this;
    }

    // OneToMany
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
        if ($this->projectPlatformReward->contains($projectPlatformReward)) {
            $this->projectPlatformReward->removeElement($projectPlatformReward);
        }

        return $this;
    }

    // OneToOne
    public function getProjectEnGb(): ProjectEnGb
    {
        return $this->projectEnGb;
    }

    public function setProjectEnGb(ProjectEnGb $projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }

    // ManyToMany
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

    // OneToOne
    public function getProjectFeatured(): Featured
    {
        return $this->projectFeatured;
    }

    public function setProjectFeatured(Featured $projectFeatured): void
    {
        $this->projectFeatured = $projectFeatured;
    }

    // OneToMeny
    public function getProjectReview(): Collection
    {
        return $this->projectReview;
    }

    public function addProjectReview(ProjectReview $projectReview): self
    {
        if (!$this->projectReview->contains($projectReview)) {
            $this->projectReview[] = $projectReview;
        }

        return $this;
    }

    public function removeProjectReview(ProjectReview $projectReview): self
    {
        if ($this->projectReview->contains($projectReview)) {
            $this->projectReview->removeElement($projectReview);
        }

        return $this;
    }
}

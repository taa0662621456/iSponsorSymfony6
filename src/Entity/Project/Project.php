<?php

namespace App\Entity\Project;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectInterface;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Project\ProjectTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Project extends RootEntity implements ObjectInterface, ProjectInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'project')]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToOne(targetEntity: ProjectTypeInterface::class, inversedBy: 'projectTypeProject')]
    #[Assert\Type(type: 'App\Entity\Project\ProjectType')]
    private ProjectTypeInterface $projectType;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY', inversedBy: 'categoryProject')]
    private CategoryInterface $projectCategory;

    #[ORM\OneToOne(mappedBy: 'projectEnGb', targetEntity: ProjectEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?ProjectEnGb $projectEnGb;

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
        parent::__construct();
        $t = new \DateTime();

        $this->projectAttachment = new ArrayCollection();
        $this->projectTag = new ArrayCollection();
        $this->projectProduct = new ArrayCollection();
        $this->projectPlatformReward = new ArrayCollection();
        $this->projectReview = new ArrayCollection();
    }

    public function getProjectCategory(): CategoryInterface
    {
        return $this->projectCategory;
    }

    public function setProjectCategory(?CategoryInterface $projectCategory): void
    {
        $this->projectCategory = $projectCategory;
    }

    public function getProjectEnGb(): ?ProjectEnGb
    {
        return $this->projectEnGb;
    }

    public function setProjectEnGb(ProjectEnGb $projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }

    public function getProjectType(): ProjectTypeInterface
    {
        return $this->projectType;
    }

    public function setProjectType(ProjectTypeInterface $projectType): void
    {
        $this->projectType = $projectType;
    }

    public function getProjectAttachment(): Collection
    {
        return $this->projectAttachment;
    }

    public function setProjectAttachment($projectAttachment): void
    {
        $this->addProjectAttachment($projectAttachment);
    }

    public function addProjectAttachment($projectAttachment): void
    {
        if ($projectAttachment instanceof ProjectAttachment) {
            if (!$this->projectAttachment->contains($projectAttachment)) {
                $this->projectAttachment->add($projectAttachment);
            }
        } elseif ($projectAttachment instanceof Collection) {
            foreach ($projectAttachment as $attachment) {
                $this->addProjectAttachment($attachment);
            }
        }
    }

    public function getProjectFavourite(): Collection
    {
        return $this->projectFavourite;
    }

    public function setProjectFavourite(Collection $projectFavourite): void
    {
        $this->projectFavourite = $projectFavourite;
    }

    public function getProjectFeatured(): Featured
    {
        return $this->projectFeatured;
    }

    public function setProjectFeatured(Featured $projectFeatured): void
    {
        $this->projectFeatured = $projectFeatured;
    }

    public function getProjectTag(): Collection
    {
        return $this->projectTag;
    }

    public function setProjectTag($projectTag): void
    {
        $this->addProjectTag($projectTag);
    }

    public function addProjectTag($projectTag): void
    {
        if ($projectTag instanceof ProjectTag) {
            if (!$this->projectTag->contains($projectTag)) {
                $this->projectTag->add($projectTag);
            }
        } elseif ($projectTag instanceof Collection) {
            foreach ($projectTag as $tag) {
                $this->addProjectTag($tag);
            }
        }
    }

    public function getProjectProduct(): Collection
    {
        return $this->projectProduct;
    }

    public function setProjectProduct(Collection $projectProduct): void
    {
        $this->projectProduct = $projectProduct;
    }

    public function getProjectPlatformReward(): Collection
    {
        return $this->projectPlatformReward;
    }

    public function setProjectPlatformReward(Collection $projectPlatformReward): void
    {
        $this->projectPlatformReward = $projectPlatformReward;
    }

    public function getProjectReview(): Collection
    {
        return $this->projectReview;
    }

    public function setProjectReview($projectReview): void
    {
        $this->addProjectReview($projectReview);
    }

    public function addProjectReview($projectReview): void
    {
        if ($projectReview instanceof ProjectReview) {
            if (!$this->projectReview->contains($projectReview)) {
                $this->projectReview->add($projectReview);
            }
        } elseif ($projectReview instanceof Collection) {
            foreach ($projectReview as $attachment) {
                $this->addProjectReview($attachment);
            }
        }
    }
}

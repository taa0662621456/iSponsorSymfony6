<?php

namespace App\Entity\Project;

use App\Entity\Product\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category\Category;
use App\Entity\Featured\Featured;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Project\ProjectInterface;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Project\ProjectTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Project extends ObjectSuperEntity implements ObjectInterface, ProjectInterface
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
        parent::__construct();
        $t = new \DateTime();

        $this->projectAttachment = new ArrayCollection();
        $this->projectTag = new ArrayCollection();
        $this->projectProduct = new ArrayCollection();
        $this->projectPlatformReward = new ArrayCollection();
        $this->projectReview = new ArrayCollection();
    }
}

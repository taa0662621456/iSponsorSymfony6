<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\Featured\Featured;
use App\Entity\Product\Product;
use App\Interface\CategoryInterface;
use App\Interface\ProjectInterface;
use App\Repository\Project\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'projects')]
#[ORM\Index(columns: ['slug'], name: 'project_idx')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Project implements ProjectInterface
{
    use BaseTrait;
    public const NUM_ITEMS = 10;

    #[ORM\Column(name: 'project_type', type: 'string', nullable: true)]
    private string $projectType;
    //TODO: поменять на связь с таблицей типов проектов
    /**
     * @var ArrayCollection
     */
    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY', inversedBy: 'categoryProjects')]
    #[ORM\JoinColumn(name: 'projectCategory_id', referencedColumnName: 'id')]
    private ArrayCollection $projectCategory;

    #[ORM\OneToOne(mappedBy: 'projectEnGb', targetEntity: ProjectEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(name: 'projectEnGb_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Project\ProjectsEnGb')]
    #[Assert\Valid]
    private ArrayCollection $projectEnGb;
    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(mappedBy: 'projectAttachments', targetEntity: ProjectAttachment::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinTable(name: 'project_attachments')]
    #[Assert\Count(max: 8, maxMessage: 'projects.too_many_files')]
    private ArrayCollection $projectAttachments;

    #[ORM\ManyToMany(targetEntity: ProjectFavourite::class, mappedBy: 'projectFavourites')]
    #[ORM\JoinTable(name: 'project_favourites')]
    private int $projectFavourites;

    #[ORM\OneToOne(mappedBy: 'projectFeatured', targetEntity: Featured::class, cascade: ['persist', 'remove'])]
    private Featured $projectFeatured;
    /**
     * @var ArrayCollection
     */
    #[ORM\ManyToMany(targetEntity: ProjectTag::class, cascade: ['persist'])]
    #[ORM\JoinTable(name: 'project_tags')]
    #[ORM\OrderBy(['name' => 'ASC'])]
    #[Assert\Count(max: 4, maxMessage: 'projects.too_many_tags')]
    private ArrayCollection $projectTags;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(mappedBy: 'products', targetEntity: Product::class, cascade: ['persist'], orphanRemoval: true)]
    #[ORM\JoinTable(name: 'project_products')]
    #[Assert\Count(max: 100, maxMessage: 'projects.too_many_files')]
    private ArrayCollection $projectProducts;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(mappedBy: 'projectId', targetEntity: ProjectPlatformReward::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinTable(name: 'project_platform_reward')]
    #[Assert\Count(max: 100, maxMessage: 'project.too_many_rewards')]
    private ArrayCollection $projectPlatformReward;

    /**
     * @throws \Exception
     */
    #[Pure]
    public function __construct()
    {
        $this->projectAttachments = new ArrayCollection();
        $this->projectTags = new ArrayCollection();
        $this->projectProducts = new ArrayCollection();
        $this->projectPlatformReward = new ArrayCollection();
    }
    public function getProjectCategory():ArrayCollection
    {
        return $this->projectCategory;
    }
    /**
     * @param $projectCategory
     */
    public function addProjectCategory($projectCategory): void
    {
        $this->projectCategory->add($projectCategory);
    }
    public function getProjectType(): ?string
    {
        return $this->projectType;
    }
    public function setProjectType(string $projectType): void
    {
        $this->projectType = $projectType;
    }
    public function addProjectTag(ProjectTag $tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->projectTags->contains($tag)) {
                $this->projectTags->add($tag);
            }
        }
    }
    public function removeProjectTag(ProjectTag $tag): void
    {
        $this->projectTags->removeElement($tag);
    }
    public function getProjectTags(): ArrayCollection
    {
        return $this->projectTags;
    }
    public function addProjectAttachment(ProjectAttachment $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (!$this->projectAttachments->contains($attachment)) {
                $this->projectAttachments->add($attachment);
            }
        }
    }
    public function removeProjectAttachment(ProjectAttachment $attachment): void
    {
        $this->projectAttachments->removeElement($attachment);
    }
    public function getProjectAttachments(): ArrayCollection
    {
        return $this->projectAttachments;
    }
    public function addProjectProducts(Product $products): void
    {
        foreach ($products as $product) {
            if (!$this->projectProducts->contains($product)) {
                $this->projectProducts->add($product);
            }
        }
    }
    public function removeProjectProducts(Product $product): void
    {
        $this->projectProducts->removeElement($product);
    }
    public function getProjectProducts(): ArrayCollection
    {
        return $this->projectProducts;
    }
    public function addProjectPlatformReward(ProjectPlatformReward $rewards): void
    {
        foreach ($rewards as $reward) {
            if (!$this->projectPlatformReward->contains($reward)) {
                $this->projectPlatformReward->add($reward);
            }
        }
    }
    public function removeProjectPlatformReward(ProjectPlatformReward $reward): void
    {
        $this->projectPlatformReward->removeElement($reward);
    }
    public function getProjectPlatformReward(): ArrayCollection
    {
        return $this->projectPlatformReward;
    }
    public function getProjectEnGb(): ArrayCollection
    {
        return $this->projectEnGb;
    }
    /**
     * @param $projectEnGb
     */
    public function setProjectEnGb($projectEnGb): void
    {
        $this->projectEnGb = $projectEnGb;
    }
    public function getProjectFavourites(): int
    {
        return $this->projectFavourites;
    }

    public function setProjectFavourites(int $projectFavourites): void
    {
        $this->projectFavourites = $projectFavourites;
    }
    public function getProjectFeatured(): Featured
    {
        return $this->projectFeatured;
    }
    /**
     * @param $projectFeatured
     */
    public function setProjectFeatured($projectFeatured): void
    {
        $this->projectFeatured = $projectFeatured;
    }
}

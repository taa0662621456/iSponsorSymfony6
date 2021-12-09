<?php

namespace App\Entity\Project;

use App\Entity\BaseTrait;
use App\Entity\Category\Category;
use App\Entity\Featured\Featured;
use App\Entity\Product\Product;
use App\Entity\Product\ProductEnGb;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Table(name="projects", indexes={
 * @ORM\Index(name="project_idx", columns={"slug"})})
 * UniqueEntity("slug"),
 *        errorPath="slug",
 *        message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Project\ProjectRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Project
{
    use BaseTrait;
    public const NUM_ITEMS = 10;

    /**
     * @var string
     * @ORM\Column(name="project_type", type="string", nullable=true)
     */
    private string $projectType; //TODO: поменять на связь с таблицей типов проектов

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category\Category",
     *      inversedBy="categoryProjects",
     *      fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="projectCategory_id", referencedColumnName="id")
     */
    private Category $projectCategory;

//TODO: отвязать категории, чтобы системные данные: категории и меню хранились и работали в отдельной БД
//    /**
//     * @ORM\ManyToOne(targetEntity="App\Entity\Category\CategoryInterface")
//     * @var CategoryInterface
//     */
//    protected CategoryInterface $projectCategory;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product\ProductEnGb",
     *     cascade={"persist", "remove"},
     *     mappedBy="projectEnGb",
     *     orphanRemoval=true)
     * @ORM\JoinColumn(name="projectEnGb_id", referencedColumnName="id", onDelete="CASCADE")
     * @Assert\Type(type="App\Entity\Project\ProjectsEnGb")
     * @Assert\Valid()
     */
    private ProductEnGb $projectEnGb;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Project\ProjectAttachment",
     *      cascade={"persist", "remove"},
     *      mappedBy="projectAttachments",
     *      orphanRemoval=true)
     * @ORM\JoinTable(name="project_attachments")
     * @Assert\Count(max="8", maxMessage="projects.too_many_files")
     */
    private ArrayCollection $projectAttachments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project\ProjectFavourite", mappedBy="projectFavourites")
     * @ORM\JoinTable(name="project_favourites")
     **/
    private int $projectFavourites;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Featured\Featured",
     *     cascade={"persist", "remove"},
     *     mappedBy="projectFeatured"
     * )
     */
    private Featured $projectFeatured;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Project\ProjectTag", cascade={"persist"})
     * @ORM\JoinTable(name="project_tags")
     * @ORM\OrderBy({"name": "ASC"})
     * @Assert\Count(max="4", maxMessage="projects.too_many_tags")
     *
     */
    private ArrayCollection $projectTags;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Product\Product",
     *      cascade={"persist"},
     *      mappedBy="products",
     *      orphanRemoval=true)
     * @ORM\JoinTable(name="project_products")
     * @Assert\Count(max="100", maxMessage="projects.too_many_files")
     */
    private ArrayCollection $projectProducts;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ProjectPlatformReward",
     *     cascade={"persist", "remove"},
     *     mappedBy="projectId",
     *     orphanRemoval=true)
     * @ORM\JoinTable(name="rewards")
     * @Assert\Count(max="100", maxMessage="project.too_many_rewards")
     */
    private ArrayCollection $projectsPlatformReward;


    /**
     * Projects constructor.
     * @throws \Exception
     */
    #[Pure]
    public function __construct()
    {
        $this->projectAttachments = new ArrayCollection();
        $this->projectTags = new ArrayCollection();
        $this->projectProducts = new ArrayCollection();
        $this->projectsPlatformReward = new ArrayCollection();
    }

    /**
     * @return Category
     */
    public function getProjectCategory(): Category
    {
        return $this->projectCategory;
    }

    /**
     * @param Category $projectCategory
     */
    public function setProjectCategory(Category $projectCategory): void
    {
        $this->projectCategory = $projectCategory;
    }

    /**
     * @return string|null
     */
    public function getProjectType(): ?string
    {
        return $this->projectType;
    }

    /**
     * @param string $projectType
     */
    public function setProjectType(string $projectType): void
    {
        $this->projectType = $projectType;
    }

    /**
     * @param ProjectTag $tags
     */
    public function addProjectTag(ProjectTag $tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->projectTags->contains($tag)) {
                $this->projectTags->add($tag);
            }
        }
    }

    /**
     * @param ProjectTag $tag
     */
    public function removeProjectTag(ProjectTag $tag): void
    {
        $this->projectTags->removeElement($tag);
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectTags(): ArrayCollection
    {
        return $this->projectTags;
    }

    /**
     * @param ProjectAttachment $attachments
     */
    public function addProjectAttachment(ProjectAttachment $attachments): void
    {
        foreach ($attachments as $attachment) {
            if (!$this->projectAttachments->contains($attachment)) {
                $this->projectAttachments->add($attachment);
            }
        }
    }

    /**
     * @param ProjectAttachment $attachment
     */
    public function removeProjectAttachment(ProjectAttachment $attachment): void
    {
        $this->projectAttachments->removeElement($attachment);
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectAttachments(): ArrayCollection
    {
        return $this->projectAttachments;
    }

    /**
     * @param Product $products
     */
    public function addProjectProducts(Product $products): void
    {
        foreach ($products as $product) {
            if (!$this->projectProducts->contains($product)) {
                $this->projectProducts->add($product);
            }
        }
    }

    /**
     * @param Product $product
     */
    public function removeProjectProducts(Product $product): void
    {
        $this->projectProducts->removeElement($product);
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectProducts(): ArrayCollection
    {
        return $this->projectProducts;
    }

    /**
     * @param ProjectPlatformReward $rewards
     */
    public function addProjectPlatformReward(ProjectPlatformReward $rewards): void
    {
        foreach ($rewards as $reward) {
            if (!$this->projectsPlatformReward->contains($reward)) {
                $this->projectsPlatformReward->add($reward);
            }
        }
    }

    /**
     * @param ProjectPlatformReward $reward
     */
    public function removeProjectPlatformReward(ProjectPlatformReward $reward): void
    {
        $this->projectsPlatformReward->removeElement($reward);
    }

    /**
     * @return ArrayCollection
     */
    public function getProjectPlatformRewards(): ArrayCollection
    {
        return $this->projectsPlatformReward;
    }

    /**
     * @return ProductEnGb
     */
    public function getProjectEnGb(): ProductEnGb
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

    /**
     * @return int
     */
    public function getProjectFavourites(): int
    {
        return $this->projectFavourites;
    }

    /**
     * @param int $projectFavourites
     */
    public function setProjectFavourites(int $projectFavourites): void
    {
        $this->projectFavourites = $projectFavourites;
    }

    /**
     * @return Featured
     */
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

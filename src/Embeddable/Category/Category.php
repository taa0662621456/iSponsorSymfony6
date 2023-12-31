<?php

namespace App\Embeddable\Category;

use App\Entity\Featured\Featured;
use App\EntityInterface\Category\CategoryInterface;
use App\EntityInterface\Featured\FeaturedInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Category
{
    #[ORM\OneToMany(mappedBy: 'categoryParent', targetEntity: CategoryInterface::class, fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $categoryChildren;

    #[ORM\ManyToOne(targetEntity: CategoryInterface::class, cascade: ['persist'], inversedBy: 'categoryChildren')]
    #[ORM\JoinColumn(nullable: true)]
    private ?CategoryInterface $categoryParent = null;

    #[ORM\OneToOne(mappedBy: 'categoryFeatured', targetEntity: FeaturedInterface::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private Featured $categoryFeatured;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->categoryChildren = new ArrayCollection();
    }

    public function getCategoryChildren(): Collection
    {
        return $this->categoryChildren;
    }

    public function setCategoryChildren(?CategoryInterface $categoryChildren): void
    {
        $this->categoryChildren = $categoryChildren;
    }

    public function getCategoryParent(): ?CategoryInterface
    {
        return $this->categoryParent;
    }

    public function setCategoryParent(Collection $categoryParent): void
    {
        $this->categoryParent = $categoryParent;
    }
    public function getCategoryFeatured(): Featured
    {
        return $this->categoryFeatured;
    }

    public function setCategoryFeatured(Featured $categoryFeatured): void
    {
        $this->categoryFeatured = $categoryFeatured;
    }

}

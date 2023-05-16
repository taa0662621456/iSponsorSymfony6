<?php

namespace App\Entity\Featured;

use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category\Category;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Featured\FeaturedInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
final class Featured extends ObjectSuperEntity implements ObjectInterface, FeaturedInterface
{
    #[ORM\Column(name: 'ordering', type: 'integer')]
    private int $ordering;

    #[ORM\Column(name: 'featured_type', type: 'string')]
    private string $featuredType;

    #[ORM\OneToOne(inversedBy: 'projectFeatured', targetEntity: Project::class)]
    #[Ignore]
    private ?Project $projectFeatured = null;

    #[ORM\OneToOne(inversedBy: 'productFeatured', targetEntity: Product::class)]
    #[Ignore]
    private ?Product $productFeatured = null;

    #[ORM\OneToOne(inversedBy: 'categoryFeatured', targetEntity: Category::class)]
    #[Ignore]
    private ?Category $categoryFeatured = null;

    #[ORM\OneToOne(inversedBy: 'vendorFeatured', targetEntity: Vendor::class)]
    #[Ignore]
    private ?Vendor $vendorFeatured = null;

    public function setOrdering(int $ordering): void
    {
        $this->ordering = $ordering;
    }

    public function getOrdering(): int
    {
        return $this->ordering;
    }

    public function getFeaturedType(): string
    {
        return $this->featuredType;
    }

    public function setFeaturedType(string $featuredType): void
    {
        $this->featuredType = $featuredType;
    }

    // OneToOne
    public function getProjectFeatured(): ?Project
    {
        return $this->projectFeatured;
    }

    public function setProjectFeatured(?Project $projectFeatured): void
    {
        $this->projectFeatured = $projectFeatured;
    }

    // OneToOne
    public function getProductFeatured(): ?Product
    {
        return $this->productFeatured;
    }

    public function setProductFeatured(?Product $productFeatured): void
    {
        $this->productFeatured = $productFeatured;
    }

    // OneToOne
    public function getCategoryFeatured(): ?Category
    {
        return $this->categoryFeatured;
    }

    public function setCategoryFeatured(?Category $categoryFeatured): void
    {
        $this->categoryFeatured = $categoryFeatured;
    }

    // OneToOne
    public function getVendorFeatured(): ?Vendor
    {
        return $this->vendorFeatured;
    }

    public function setVendorFeatured(?Vendor $vendorFeatured): void
    {
        $this->vendorFeatured = $vendorFeatured;
    }
}

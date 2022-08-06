<?php


namespace App\Entity\Featured;

use App\Entity\BaseTrait;
use App\Entity\Category\Category;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Vendor\Vendor;
use App\Repository\Featured\FeaturedRepository;
use Doctrine\ORM\Mapping as ORM;


 #[ORM\Table(name: 'feature')]
#[ORM\Entity(repositoryClass: FeaturedRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Featured
{
    use BaseTrait;

    #[ORM\Column(name: 'ordering', type: 'integer')]
    private int $ordering;

    #[ORM\Column(name: 'featured_type', type: 'string')]
    private string $featuredType;

    #[ORM\OneToOne(inversedBy: 'projectFeatured', targetEntity: Project::class)]
    private ?Project $projectFeatured = null;

    #[ORM\OneToOne(inversedBy: 'productFeatured', targetEntity: Product::class)]
    private ?Product $productFeatured = null;

    #[ORM\OneToOne(inversedBy: 'categoryFeatured', targetEntity: Category::class)]
    private ?Category $categoryFeatured = null;

    #[ORM\OneToOne(inversedBy: 'vendorFeatured', targetEntity: Vendor::class)]
    private ?Vendor $vendorFeatured = null;

    public function setOrdering($ordering): static
    {
     $this->ordering = $ordering;
     return $this;
    }
    public function getOrdering(): int
    {
     return $this->ordering;
    }
    #
    public function getFeaturedType(): string
    {
     return $this->featuredType;
    }
    public function setFeaturedType(string $featuredType): void
    {
     $this->featuredType = $featuredType;
    }
    # OneToOne
    public function getProjectFeatured(): ?Project
    {
     return $this->projectFeatured;
    }
    public function setProjectFeatured(?Project $projectFeatured): void
    {
     $this->projectFeatured = $projectFeatured;
    }
    # OneToOne
    public function getProductFeatured(): ?Product
    {
     return $this->productFeatured;
    }
    public function setProductFeatured(?Product $productFeatured): void
    {
     $this->productFeatured = $productFeatured;
    }
    # OneToOne
    public function getCategoryFeatured(): ?Category
    {
     return $this->categoryFeatured;
    }
    public function setCategoryFeatured(?Category $categoryFeatured): void
    {
     $this->categoryFeatured = $categoryFeatured;
    }
    # OneToOne
    public function getVendorFeatured(): ?Vendor
    {
     return $this->vendorFeatured;
    }
    public function setVendorFeatured(?Vendor $vendorFeatured): void
    {
     $this->vendorFeatured = $vendorFeatured;
    }


}

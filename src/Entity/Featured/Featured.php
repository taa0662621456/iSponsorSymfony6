<?php


namespace App\Entity\Featured;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\CodeNameFilterTrait;
use App\Api\Filter\ModuleMenuFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\Category\Category;
use App\Entity\ObjectTrait;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Vendor\Vendor;
use App\Repository\Featured\FeaturedRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Serializer\Annotation\Ignore;


#[ORM\Table(name: 'feature')]
#[ORM\Entity(repositoryClass: FeaturedRepository::class)]
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
class Featured
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use StatusFilterTrait;
    use TimestampFilterTrait;
    use RelationFilterTrait;

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
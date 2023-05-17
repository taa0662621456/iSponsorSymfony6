<?php

namespace App\Entity\Featured;

use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category\Category;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Featured\FeaturedInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
class Featured extends ObjectSuperEntity implements ObjectInterface, FeaturedInterface
{
    #[ORM\Column(name: 'ordering', type: 'integer')]
    private int $ordering = 0;

    #[ORM\Column(name: 'featured_type', type: 'string', nullable: 'true')]
    private ?string $featuredType = null;

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
}

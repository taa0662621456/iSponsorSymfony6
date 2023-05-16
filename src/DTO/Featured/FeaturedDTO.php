<?php

namespace App\DTO\Featured;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\Category\Category;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use App\Entity\Vendor\Vendor;
use Symfony\Component\Serializer\Annotation\Ignore;

final class FeaturedDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private int $orderingDTO;

    private string $featuredTypeDTO;

    #[Ignore]
    private ?Project $projectFeatured = null;

    #[Ignore]
    private ?Product $productFeatured = null;

    #[Ignore]
    private ?Category $categoryFeatured = null;

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

    public function getFeaturedType(): string
    {
        return $this->featuredType;
    }

    public function setFeaturedType(string $featuredType): void
    {
        $this->featuredType = $featuredType;
    }
}

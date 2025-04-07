<?php

namespace App\Entity\Featured;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\Entity\Vendor\Vendor;
use App\Entity\Product\Product;
use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Featured\FeaturedInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
class Featured extends RootEntity implements ObjectInterface, FeaturedInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


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

    #[ORM\OneToOne(inversedBy: 'vendorFeatured', targetEntity: Vendor::class)]
    #[Ignore]
    private ?Vendor $vendorFeatured = null;
}

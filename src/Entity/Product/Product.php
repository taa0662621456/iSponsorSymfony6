<?php

namespace App\Entity\Product;

use App\Entity\Order\OrderItem;
use App\Entity\Project\Project;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Featured\Featured;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Product\ProductInterface;
use Symfony\Component\Serializer\Annotation\Ignore;
use App\EntityInterface\Product\ProductTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Product extends ObjectSuperEntity implements ObjectInterface, ProductInterface
{
    public const NUM_ITEMS = 10;

    #[ORM\ManyToOne(targetEntity: ProductTypeInterface::class, inversedBy: 'productTypeProduct')]
    #[Assert\Type(type: 'App\Entity\Product\ProductType')]
    #[Assert\Valid]
    private ProductType $productType;

    #[ORM\Column(name: 'product_category', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productCategory = 0;

    #[ORM\Column(name: 'product_hit', type: 'integer', nullable: false, options: ['default' => 0])]
    private int $productHit = 0;

    #[ORM\Column(name: 'layout', type: 'integer', nullable: false, options: ['default' => 0])]
    private ?int $layout = 0;

    #[ORM\Column(name: 'product_published', type: 'boolean', nullable: false, options: ['default' => true])]
    private bool $productPublished = true;

    #[ORM\Column(name: 'product_country_origin', type: 'string', nullable: false, options: ['default' => 'product_country_origin'])]
    private string $productCountryOrigin = 'product_country_origin';

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'projectProduct')]
    private Project $productProject;

    #[ORM\OneToMany(mappedBy: 'productOrdered', targetEntity: OrderItem::class)]
    private Collection $productOrdered;

    #[ORM\OneToOne(targetEntity: ProductEnGb::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Product\ProductsEnGb')]
    #[Assert\Valid]
    #[Ignore]
    private ProductEnGb $productEnGb;

    #[ORM\OneToOne(targetEntity: ProductProperty::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    #[Assert\Type(type: 'App\Entity\Product\ProductProperty')]
    #[Assert\Valid]
    #[Ignore]
    private ProductProperty $productProperty;

    #[ORM\ManyToMany(targetEntity: ProductTag::class, inversedBy: 'productTagProduct', cascade: ['persist'])]
    #[ORM\OrderBy(['firstTitle' => 'ASC'])]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTag;

    #[ORM\OneToOne(mappedBy: 'productPrice', targetEntity: ProductPrice::class, fetch: 'EAGER', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Product\ProductsPrice')]
    #[Assert\Valid]
    #[Ignore]
    private ProductPrice $productPrice;

    #[ORM\OneToOne(mappedBy: 'productStorage', targetEntity: ProductStorage::class, fetch: 'EAGER', orphanRemoval: true)]
    #[Assert\Type(type: 'App\Entity\Product\ProductStorage')]
    #[Assert\Valid]
    #[Ignore]
    private ProductStorage $productStorage;

    #[ORM\ManyToMany(targetEntity: ProductFavourite::class, mappedBy: 'productFavourite')]
    private Collection $productFavourite;

    #[ORM\OneToOne(mappedBy: 'productFeatured', targetEntity: Featured::class)]
    #[Ignore]
    private Featured $productFeatured;

    #[ORM\OneToMany(mappedBy: 'productAttachmentProduct', targetEntity: ProductAttachment::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productAttachment;

    #[ORM\OneToMany(mappedBy: 'productReviewProduct', targetEntity: ProductReview::class, cascade: ['persist', 'remove'], fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productReview;

    public function __construct()
    {
        parent::__construct();
        $this->productAttachment = new ArrayCollection();
        $this->productOrdered = new ArrayCollection();
        $this->productTag = new ArrayCollection();
        $this->productReview = new ArrayCollection();
    }
}

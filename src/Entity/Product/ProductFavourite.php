<?php


namespace App\Entity\Product;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Vendor\Vendor;
use App\Repository\Product\ProductFavouriteRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(
    name: 'product_favourite',
    indexes: [
    new ORM\Index(columns: ['product_id'], name: 'idx_product_favourite_product'),
    new ORM\Index(columns: ['vendor_id'], name: 'idx_product_favourite_vendor')
],
    uniqueConstraints: [
    new ORM\UniqueConstraint(name: 'uniq_product_favourite', columns: ['product_id','vendor_id'])
])]
#[ORM\Index(columns: ['slug'], name: 'product_favourite_idx')]
#[ORM\Entity(repositoryClass: ProductFavouriteRepository::class)]
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
class ProductFavourite
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use StatusFilterTrait;
    use RelationFilterTrait;

	#[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'productFavourite')]
	private Product $productFavourite;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Product $product = null;

    #[ORM\ManyToOne(targetEntity: Vendor::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Vendor $customer = null;

	public function getProductFavourite(): Product
	{
		return $this->productFavourite;
	}

	public function setProductFavourite(Product $productFavourite): void
	{
		$this->productFavourite = $productFavourite;
	}
}

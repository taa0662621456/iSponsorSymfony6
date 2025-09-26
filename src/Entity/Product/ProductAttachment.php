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
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Product\ProductAttachmentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'product_attachment')]
#[ORM\Index(columns: ['slug'], name: 'product_attachment_idx')]
#[ORM\Entity(repositoryClass: ProductAttachmentRepository::class)]
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
class ProductAttachment
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use RelationFilterTrait;
    use AttachmentTrait;

	#[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productAttachment')]
	#[ORM\JoinColumn(onDelete: 'CASCADE')]
	private Product $productAttachmentProduct;

    # ManyToOne
	public function getProductAttachmentProduct(): Product
    {
		return $this->productAttachmentProduct;
	}
    public function setProductAttachmentProduct(Product $product): void
    {
            $this->productAttachmentProduct = $product;
    }

}

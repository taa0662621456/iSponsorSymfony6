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
use App\Api\Filter\CodeNameFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use JsonSerializable;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(
    name: 'product_tag',
    indexes: [
        new ORM\Index(columns: ['product_id'], name: 'idx_product_tag_product'),
        new ORM\Index(columns: ['tag'], name: 'idx_product_tag_tag')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_product_tag', columns: ['product_id','tag'])
    ]
)]
#[ORM\Index(columns: ['slug'], name: 'product_tag_idx')]
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
class ProductTag implements JsonSerializable
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use CodeNameFilterTrait;
    use RelationFilterTrait;

    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->productTagProduct = new ArrayCollection();

        $this->lastRequestAt = clone $t;
        $this->createdAt = clone $t;
        $this->modifiedAt = clone $t;
        $this->lockedAt = clone $t;
        $this->published = true;
    }

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'productTag')]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTagProduct;


    # ManyToMany
    public function getProductTagProduct(): Collection
    {
        return $this->productTagProduct;
    }
    public function addProductTagProduct(Product $product): void
    {
        if (!$this->productTagProduct->contains($product)) {
            $this->productTagProduct[] = $product;
        }
    }
    public function removeProductTagProduct(Product $product): self
    {
        if ($this->productTagProduct->removeElement($product)) {
            $product->removeProductTag($this);
        }
        return $this;
    }

    public function jsonSerialize(): string
	{
		// This entity implements JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
		// so this method is used to customize its JSON representation when json_encode()
		// is called, for example in tags|json_encode (app/Resources/views/form/fields.html.twig)
		return $this->firstTitle;
	}
	public function __toString(): string
	{
		return $this->firstTitle;
	}
}
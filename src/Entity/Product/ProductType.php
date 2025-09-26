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
use App\Interface\Product\ProductTypeInterface;
use App\Repository\Type\ProductTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Exception;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'product_type', uniqueConstraints: [
    new ORM\UniqueConstraint(name: 'uniq_product_type_code', columns: ['slug'])
])]
#[ORM\Index(columns: ['slug'], name: 'product_type_idx')]
#[ORM\Entity(repositoryClass: ProductTypeRepository::class)]
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
class ProductType implements ProductTypeInterface
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use CodeNameFilterTrait;
    use RelationFilterTrait;

    #[ORM\OneToMany(mappedBy: 'productType', targetEntity: Product::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productTypeProduct;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();
        $this->productTypeProduct = new ArrayCollection();

        $this->lastRequestAt = clone $t;
        $this->createdAt = clone $t;
        $this->modifiedAt = clone $t;
        $this->lockedAt = clone $t;
        $this->published = true;
    }
    # OneToMany
    public function getProductTypeProduct(): Collection
    {
        return $this->productTypeProduct;
    }
    public function addProductTypeProduct(Product $product): self
    {
        if (!$this->productTypeProduct->contains($product)){
            $this->productTypeProduct[] = $product;
        }
        return $this;
    }
    public function removeProductTypeProduct(Product $product): self
    {
        if ($this->productTypeProduct->contains($product)){
            $this->productTypeProduct->removeElement($product);
        }
        return $this;
    }



}

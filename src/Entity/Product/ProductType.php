<?php

namespace App\Entity\Product;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Interface\Product\ProductTypeInterface;
use App\Repository\Type\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'product_type')]
#[ORM\Index(columns: ['slug'], name: 'product_type_idx')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ProductType implements ProductTypeInterface
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

    #[ORM\OneToMany(mappedBy: 'productType', targetEntity: Product::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productTypeProduct;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $t = new \DateTime();
        $this->slug = (string)Uuid::v4();
        $this->productTypeProduct = new ArrayCollection();


        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
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

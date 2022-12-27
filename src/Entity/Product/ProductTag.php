<?php

namespace App\Entity\Product;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: 'product_tag')]
#[ORM\Index(columns: ['slug'], name: 'product_tag_idx')]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class ProductTag implements JsonSerializable
{
	use BaseTrait;
    use ObjectTrait;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'productTag')]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTagProduct;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->productTagProduct = new ArrayCollection();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }


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

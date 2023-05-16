<?php

namespace App\Entity\Product;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use App\Interface\Product\ProductTagInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
final class ProductTag extends ObjectSuperEntity implements ObjectInterface, ProductTagInterface, \JsonSerializable
{
    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'productTag')]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTagProduct;

    public function __construct()
    {
        $this->productTagProduct = new ArrayCollection();
    }

    // ManyToMany
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
        // This entity implements ObjectInterface, JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
        // so this method is used to customize its JSON representation when json_encode()
        // is called, for example in tags|json_encode (app/Resources/views/form/fields.html.twig)
        return $this->firstTitle;
    }

    public function __toString(): string
    {
        return $this->firstTitle;
    }
}

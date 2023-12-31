<?php

namespace App\Entity\Product;

use JsonSerializable;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Product\ProductTagInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class ProductTag extends RootEntity implements ObjectInterface, ProductTagInterface, \JsonSerializable
{
    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'productTag')]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTagProduct;

    public function __construct()
    {
        parent::__construct();
        $this->productTagProduct = new ArrayCollection();
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

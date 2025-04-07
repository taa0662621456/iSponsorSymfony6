<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Product\ProductTagInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @property $firstTitle
 */
#[ORM\Entity]
class ProductTag extends RootEntity implements ObjectInterface, ProductTagInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'productTag')]
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTag;

    public function __construct()
    {
        parent::__construct();
        $this->productTag = new ArrayCollection();
    }
}

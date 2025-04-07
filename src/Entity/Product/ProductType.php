<?php

namespace App\Entity\Product;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Product\ProductTypeInterface;
use Exception;

#[ORM\Entity]
class ProductType extends RootEntity implements ObjectInterface, ProductTypeInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\OneToMany(mappedBy: 'productType', targetEntity: Product::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productTypeProduct;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->productTypeProduct = new ArrayCollection();
    }
}

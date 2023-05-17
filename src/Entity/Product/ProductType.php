<?php

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Product\ProductTypeInterface;

#[ORM\Entity]
class ProductType extends ObjectSuperEntity implements ObjectInterface, ProductTypeInterface
{
    #[ORM\OneToMany(mappedBy: 'productType', targetEntity: Product::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $productTypeProduct;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->productTypeProduct = new ArrayCollection();
    }
}

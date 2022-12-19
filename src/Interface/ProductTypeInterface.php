<?php

namespace App\Interface;

use App\Entity\Product\Product;
use Doctrine\Common\Collections\Collection;

interface ProductTypeInterface
{
    # OneToMany
    public function getProductTypeProduct(): Collection;
    public function addProductTypeProduct(Product $product): self;
    public function removeProductTypeProduct(Product $product): self;
}

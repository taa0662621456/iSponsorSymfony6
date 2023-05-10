<?php

namespace App\DTO\Product;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;


final class ProductTypeDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Collection $productTypeProduct;
}

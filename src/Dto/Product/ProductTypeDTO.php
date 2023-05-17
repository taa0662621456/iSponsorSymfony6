<?php

namespace App\Dto\Product;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;


final class ProductTypeDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Collection $productTypeProductDTO;
}

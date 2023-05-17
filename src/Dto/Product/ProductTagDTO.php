<?php

namespace App\Dto\Product;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

final class ProductTagDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    #[Assert\Count(max: 4, maxMessage: 'product.too_many_tags')]
    private Collection $productTagProductDTO;
}

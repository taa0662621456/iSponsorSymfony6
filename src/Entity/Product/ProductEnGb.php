<?php

namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Product\ProductRepository;
use Doctrine\ORM\Mapping as ORM;




#[ORM\Table(name: 'products_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'product_en_gb_idx')]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProductLanguageTrait;
}

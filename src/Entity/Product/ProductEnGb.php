<?php

namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;




/**
 * @ORM\Table(name="products_en_gb", indexes={
 * @ORM\Index(name="product_en_gb_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Product\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use ProductLanguageTrait;
}

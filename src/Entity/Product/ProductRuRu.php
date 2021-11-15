<?php


namespace App\Entity\Product;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Project\ProjectLanguageTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_ru_ru", indexes={
 * @ORM\Index(name="product_ru_ru_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use ProjectLanguageTrait;
}

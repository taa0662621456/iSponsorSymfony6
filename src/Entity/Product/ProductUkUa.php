<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_uk_ua", indexes={
 * @ORM\Index(name="product_uk_ua_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ProductUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use ProductLanguageTrait;


}

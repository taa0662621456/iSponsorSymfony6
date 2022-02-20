<?php


namespace App\Entity\Product;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_uk_ua')]
#[ORM\Index(columns: ['slug'], name: 'product_uk_ua_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use ProductLanguageTrait;
}

<?php


namespace App\Entity\Product;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'product_ru_ru')]
#[ORM\Index(columns: ['slug'], name: 'product_ru_ru_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ProductRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use ProductLanguageTrait;
}

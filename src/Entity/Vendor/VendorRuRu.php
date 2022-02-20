<?php


namespace App\Entity\Vendor;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendors_ru_ru')]
#[ORM\Index(columns: ['slug'], name: 'vendor_ru_ru_idx')]
#[ORM\Entity(repositoryClass: \App\Repository\Vendor\VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorRuRu
{
    use BaseTrait;
    use ObjectTrait;
    use VendorLanguageTrait;
}

<?php


namespace App\Entity\Vendor;


use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendors_uk_ua')]
#[ORM\Index(columns: ['slug'], name: 'vendor_uk_ua_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorUkUa
{
    use BaseTrait;
    use ObjectTrait;
    use VendorLanguageTrait;
}

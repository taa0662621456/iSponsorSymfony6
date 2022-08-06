<?php


namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'vendor_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'vendor_en_gb_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use VendorLanguageTrait;
}

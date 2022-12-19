<?php

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'vendor_en_us')]
#[ORM\Index(columns: ['slug'], name: 'vendor_en_us_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorEnUS
{
    use BaseTrait;
    use ObjectTrait;
    use MetaTrait;
    use VendorLanguageTrait;
}

<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use App\Repository\Vendor\VendorProfileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ApiResource()
 *
 */
#[ORM\Table(name: 'vendor_profile')]
#[ORM\Index(columns: ['slug', 'vendor_phone'], name: 'vendor_profile_idx')]
#[ORM\UniqueConstraint(name: 'vendor_profile_idx', columns: ['slug', 'vendor_phone'])]
//#[UniqueEntity(errorPath: 'vendor_phone', message: 'phone.already.use')]
//#[UniqueEntity(errorPath: 'slug', message: 'slug.already.use')]
#[ORM\Entity(repositoryClass: VendorProfileRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorProfile
{
    use VendorLanguageTrait;
    use ObjectTrait;
    use BaseTrait;
}

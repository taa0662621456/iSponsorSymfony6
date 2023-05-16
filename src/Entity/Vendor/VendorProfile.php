<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Entity\VendorLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorProfileInterface;

#[ORM\UniqueConstraint(name: 'vendor_profile_idx', columns: ['slug', 'vendor_phone'])]
// #[UniqueEntity(errorPath: 'vendor_phone', message: 'phone.already.use')]
// #[UniqueEntity(errorPath: 'slug', message: 'slug.already.use')]

#[ORM\Entity]
final class VendorProfile extends ObjectSuperEntity implements ObjectInterface, VendorProfileInterface
{
    use VendorLanguageTrait;
}

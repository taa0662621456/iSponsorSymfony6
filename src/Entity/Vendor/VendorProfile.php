<?php

namespace App\Entity\Vendor;

use App\Entity\ObjectSuperEntity;
use App\Entity\VendorLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorProfileInterface;
use App\Repository\Vendor\VendorProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_profile')]
#[ORM\Index(columns: ['slug', 'vendor_phone'], name: 'vendor_profile_idx')]
#[ORM\UniqueConstraint(name: 'vendor_profile_idx', columns: ['slug', 'vendor_phone'])]
// #[UniqueEntity(errorPath: 'vendor_phone', message: 'phone.already.use')]
// #[UniqueEntity(errorPath: 'slug', message: 'slug.already.use')]
#[ORM\Entity(repositoryClass: VendorProfileRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class VendorProfile extends ObjectSuperEntity implements ObjectInterface, VendorProfileInterface
{
    use VendorLanguageTrait;
}

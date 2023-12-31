<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\VendorLanguageTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class VendorShopUser extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
    use VendorLanguageTrait;

    #[ORM\OneToOne(targetEntity: Vendor::class, inversedBy: 'vendorShop')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?Vendor $vendorShop = null;
}

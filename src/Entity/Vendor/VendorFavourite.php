<?php

namespace App\Entity\Vendor;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Vendor\VendorFavouriteInterface;

#[ApiResource(mercure: true)]
#[ORM\Entity]
class VendorFavourite extends RootEntity implements ObjectInterface, VendorFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorFavourite')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorFavourite;

    public function __construct()
    {
        parent::__construct();
        $this->vendorFavourite = new ArrayCollection();
    }
}

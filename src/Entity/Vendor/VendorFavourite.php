<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Interface\Vendor\VendorFavouriteInterface;

#[ApiResource(mercure: true)]
#[ORM\Entity]
final class VendorFavourite extends ObjectSuperEntity implements ObjectInterface, VendorFavouriteInterface
{
    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorFavourite')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private Collection $vendorFavourite;

    public function __construct()
    {
        $this->vendorFavourite = new ArrayCollection();
    }

    // ManyToMany
    public function getVendorFavourite(): Collection
    {
        return $this->vendorFavourite;
    }

    public function addVendorFavourite(Vendor $vendorFavourite): self
    {
        if (!$this->vendorFavourite->contains($vendorFavourite)) {
            $this->vendorFavourite[] = $vendorFavourite;
        }

        return $this;
    }

    public function removeVendorFavourite(Vendor $vendorFavourite): self
    {
        if ($this->vendorFavourite->contains($vendorFavourite)) {
            $this->vendorFavourite->removeElement($vendorFavourite);
        }

        return $this;
    }
}

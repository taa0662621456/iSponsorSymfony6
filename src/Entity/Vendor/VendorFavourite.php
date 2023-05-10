<?php

namespace App\Entity\Vendor;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorFavouriteInterface;
use App\Repository\Vendor\VendorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_favourite')]
#[ORM\Index(columns: ['slug'], name: 'vendor_favourite_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]

#[ApiResource(mercure: true)]
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

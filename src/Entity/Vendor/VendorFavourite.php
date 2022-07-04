<?php


namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendors_favourites')]
#[ORM\Index(columns: ['slug'], name: 'vendor_favourite_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
class VendorFavourite
{
	use BaseTrait;
	#[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorFavourite')]
	#[ORM\JoinColumn(name: 'vendorFavourites_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
	private int $vendorFavourites;
	public function getVendorFavourites(): int
	{
		return $this->vendorFavourites;
	}
	public function setVendorFavourites(int $vendorFavourites): void
	{
		$this->vendorFavourites = $vendorFavourites;
	}
}

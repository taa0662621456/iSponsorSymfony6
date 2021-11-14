<?php
declare(strict_types=1);

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="vendors_favourites", indexes={
 * @ORM\Index(name="vendor_favourite_idx", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorRepository")
 */
class VendorFavourite
{
	use BaseTrait;

	/**
	 * @ORM\ManyToMany(targetEntity="App\Entity\Vendor\Vendor", inversedBy="vendorFavourites")
	 * @ORM\JoinColumn(name="vendorFavourites_id", referencedColumnName="id", onDelete="CASCADE", nullable=true)
	 */
	private int $vendorFavourites;


	/**
	 * @return int
	 */
	public function getVendorFavourites(): int
	{
		return $this->vendorFavourites;
	}

	/**
	 * @param int $vendorFavourites
	 */
	public function setVendorFavourites(int $vendorFavourites): void
	{
		$this->vendorFavourites = $vendorFavourites;
	}
}

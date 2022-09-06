<?php


namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_media')]
#[ORM\Index(columns: ['slug'], name: 'vendor_media_idx')]
#[ORM\Entity(repositoryClass: VendorMediaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class VendorMedia
{
	use BaseTrait;
    use ObjectTrait;
    use AttachmentTrait;

	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMedia')]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
	private Vendor $vendorMediaVendor;

    # ManyToOne
	public function getVendorMediaVendor(): Vendor
    {
		return $this->vendorMediaVendor;
	}
	public function setVendorMediaVendor(Vendor $vendorMediaVendor): void
	{
		$this->vendorMediaVendor = $vendorMediaVendor;
	}
}

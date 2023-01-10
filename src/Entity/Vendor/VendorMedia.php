<?php


namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\AttachmentTrait;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Repository\Vendor\VendorMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'vendor_media')]
#[ORM\Index(columns: ['slug'], name: 'vendor_media_idx')]
#[ORM\Entity(repositoryClass: VendorMediaRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(mercure: true)]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class VendorMedia
{
	use ObjectBaseTrait;
    use ObjectTitleTrait;
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

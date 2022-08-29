<?php


namespace App\Entity\Vendor;

use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorMediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Table(name: 'vendor_media')]
#[ORM\Index(columns: ['slug'], name: 'vendor_media_idx')]
#[ORM\Entity(repositoryClass: VendorMediaRepository::class)]
#[Vich\Uploadable]
#[ORM\HasLifecycleCallbacks]
class VendorMedia
{
	use BaseTrait;
    use ObjectTrait;
	use AttachmentTrait;


    #[Vich\UploadableField(mapping: 'vendorMedia',fileNameProperty: 'file_name')]
    private ?File $fileVich = null;


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

<?php


namespace App\Entity\Vendor;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\AttachmentFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorDocumentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(
    name: 'vendor_document',
    indexes: [
        new ORM\Index(columns: ['vendor_id'], name: 'idx_vendor_document_vendor')
    ]
)]
#[ORM\Index(columns: ['slug'], name: 'vendor_document_idx')]
#[ORM\Entity(repositoryClass: VendorDocumentRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class VendorDocument
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    use AttachmentTrait;
    # API Filters
    use TimestampFilterTrait;
    use AttachmentFilterTrait;

	#[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorDocument')]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
	private Vendor $vendorDocumentVendor;

    # ManyToOne
	public function getVendorDocumentVendor(): Vendor
    {
		return $this->vendorDocumentVendor;
	}
	public function setVendorDocumentVendor(Vendor $vendorDocumentVendor): void
	{
		$this->vendorDocumentVendor = $vendorDocumentVendor;
	}
}

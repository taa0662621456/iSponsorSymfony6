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
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'vendor_favourite')]
#[ORM\Index(columns: ['slug'], name: 'vendor_favourite_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
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
class VendorFavourite
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use RelationFilterTrait;

	#[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorFavourite')]
	#[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
	private Collection $vendorFavourite;

    public function __construct()
    {
        $this->vendorFavourite = new ArrayCollection();
    }

    # ManyToMany
	public function getVendorFavourite(): Collection
	{
		return $this->vendorFavourite;
	}
	public function addVendorFavourite(Vendor $vendorFavourite): self
	{
        if (!$this->vendorFavourite->contains($vendorFavourite)){
            $this->vendorFavourite[] = $vendorFavourite;
        }
        return $this;
	}
    public function removeVendorFavourite(Vendor $vendorFavourite): self
    {
        if ($this->vendorFavourite->contains($vendorFavourite)){
            $this->vendorFavourite->removeElement($vendorFavourite);
        }
        return $this;
    }
}
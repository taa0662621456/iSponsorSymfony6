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
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(
    name: 'vendor_conversation',
    indexes: [
        new ORM\Index(columns: ['vendor_id'], name: 'idx_vendor_conversation_vendor')
    ]
)]
#[ORM\Index(columns: ['slug'], name: 'vendor_conversation_idx')]
#[ORM\Entity(repositoryClass: VendorConversationRepository::class)]
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
class VendorConversation
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use RelationFilterTrait;
    use StatusFilterTrait;

    #[ORM\OneToMany(mappedBy: 'vendorMessageConversation', targetEntity: VendorMessage::class)]
    private Collection $vendorConversationMessage;

    #[ORM\ManyToMany(targetEntity: Vendor::class, inversedBy: 'vendorConversation')]
    private Collection $vendorConversationVendor;
    #
    public function __construct()
    {
        $this->vendorConversationMessage = new ArrayCollection();
        $this->vendorConversationVendor = new ArrayCollection();
    }
    # OneToMany
    public function getVendorConversationMessage(): Collection
    {
        return $this->vendorConversationMessage;
    }
    public function addVendorMessage(VendorMessage $vendorMessage): self
    {
        if (!$this->vendorConversationMessage->contains($vendorMessage)) {
            $this->vendorConversationMessage[] = $vendorMessage;
        }
        return $this;
    }
    public function removeVendorMessage(VendorMessage $vendorMessage): self
    {
        if ($this->vendorConversationMessage->contains($vendorMessage)) {
            $this->vendorConversationMessage->removeElement($vendorMessage);
        }

        return $this;
    }
    # OneToMany
    public function getVendorConversationVendor(): Collection
    {
        return $this->vendorConversationVendor;
    }
    public function addVendorConversationVendor(Vendor $vendorConversationVendor): self
    {
        if (!$this->vendorConversationVendor->contains($vendorConversationVendor)){
            $this->vendorConversationVendor[] = $vendorConversationVendor;
        }
        return $this;
    }
    public function removeVendorConversationVendor(Vendor $vendorConversationVendor): self
    {
        if ($this->vendorConversationVendor->contains($vendorConversationVendor)){
            $this->vendorConversationVendor->removeElement($vendorConversationVendor);
        }
        return $this;
    }
    #


}

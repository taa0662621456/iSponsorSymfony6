<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorMessageInterface;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;

/**
 * Class VendorMessage.
 */
#[ApiResource(mercure: ['private' => true])]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
#[ApiFilter(SearchFilter::class, properties: [
    'vendor_message' => 'partial',
    'vendor_message_conversation' => 'partial',
])]
#[ORM\Entity]
final class VendorMessage extends ObjectSuperEntity implements ObjectInterface, VendorMessageInterface
{
    #[ORM\Column(type: 'text')]
    private mixed $messageMine;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMessage')]
    private Vendor $vendorMessage;

    #[ORM\ManyToOne(targetEntity: VendorConversation::class, inversedBy: 'vendorConversationMessage')]
    private VendorConversation $vendorMessageConversation;

    public function getMessageMine(): mixed
    {
        return $this->messageMine;
    }

    public function setMessageMine($messageMine): void
    {
        $this->messageMine = $messageMine;
    }

    // ManyToOne
    public function getVendorMessageConversation(): VendorConversation
    {
        return $this->vendorMessageConversation;
    }

    public function setVendorMessageConversation(VendorConversation $vendorMessageConversation): void
    {
        $this->vendorMessageConversation = $vendorMessageConversation;
    }

    // ManyToOne
    public function getVendorMessage(): Vendor
    {
        return $this->vendorMessage;
    }

    public function cetVendorMessage(Vendor $vendorMessage): void
    {
        $this->vendorMessage = $vendorMessage;
    }
}

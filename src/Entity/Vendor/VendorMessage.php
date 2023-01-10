<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Repository\Vendor\VendorMessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VendorMessage
 * @package App\Entity\Vendor
 */
#[ORM\Table(name: 'vendor_message')]
#[ORM\Index(columns: ['slug'], name: 'vendor_message_idx')]
#[ORM\Entity(repositoryClass: VendorMessageRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(mercure: ["private" => true])]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "vendor_message" => "partial",
    "vendor_message_conversation" => "partial",
])]
class VendorMessage
{
    use ObjectBaseTrait;

    #[ORM\Column(type: 'text')]
    private mixed $messageMine;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMessage')]
    private Vendor $vendorMessage;

    #[ORM\ManyToOne(targetEntity: VendorConversation::class, inversedBy: 'vendorConversationMessage')]
    private VendorConversation $vendorMessageConversation;

    #
    public function getMessageMine(): mixed
    {
        return $this->messageMine;
    }
    public function setMessageMine($messageMine): void
    {
        $this->messageMine = $messageMine;
    }
    # ManyToOne
    public function getVendorMessageConversation(): VendorConversation
    {
        return $this->vendorMessageConversation;
    }
    public function setVendorMessageConversation(VendorConversation $vendorMessageConversation): void
    {

        $this->vendorMessageConversation = $vendorMessageConversation;
    }
    # ManyToOne
    public function getVendorMessage(): Vendor
    {
        return $this->vendorMessage;
    }
    public function cetVendorMessage(Vendor $vendorMessage): void
    {
            $this->vendorMessage = $vendorMessage;
    }
    #


}

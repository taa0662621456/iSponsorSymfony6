<?php

namespace App\Entity\Vendor;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\AttachmentFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\StatusFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\AttachmentTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Vendor\VendorMessageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

/**
 * Class VendorMessage
 * @package App\Entity\Vendor
 */
#[ORM\Table(
    name: 'vendor_message',
    indexes: [
        new ORM\Index(columns: ['conversation_id'], name: 'idx_vendor_message_conversation'),
        new ORM\Index(columns: ['sender_id'], name: 'idx_vendor_message_sender'),
        new ORM\Index(columns: ['created_at'], name: 'idx_vendor_message_created')
    ]
)]
#[ORM\Index(columns: ['slug'], name: 'vendor_message_idx')]
#[ORM\Entity(repositoryClass: VendorMessageRepository::class)]
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
class VendorMessage
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use RelationFilterTrait;
    use StatusFilterTrait;

    #[ORM\Column(type: 'text')]
    private mixed $message;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMessage')]
    private Vendor $vendorMessage;

    #[ORM\ManyToOne(targetEntity: VendorConversation::class, inversedBy: 'vendorConversationMessage')]
    private VendorConversation $vendorMessageConversation;

    #
    public function getMessage(): mixed
    {
        return $this->message;
    }
    public function setMessage($message): void
    {
        $this->message = $message;
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

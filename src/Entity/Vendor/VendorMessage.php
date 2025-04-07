<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\EntityInterface\Object\ObjectInterface;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use App\EntityInterface\Vendor\VendorMessageInterface;

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
class VendorMessage extends RootEntity implements ObjectInterface, VendorMessageInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(type: 'text')]
    private mixed $messageMine;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'vendorMessage')]
    private Vendor $vendorMessage;

    #[ORM\ManyToOne(targetEntity: VendorConversation::class, inversedBy: 'vendorConversationMessage')]
    private VendorConversation $vendorMessageConversation;
}

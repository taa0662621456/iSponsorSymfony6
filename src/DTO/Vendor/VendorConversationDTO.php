<?php

namespace App\DTO\Vendor;

use ApiPlatform\Metadata\ApiResource;
use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use Doctrine\Common\Collections\Collection;

#[ApiResource(mercure: true)]
final class VendorConversationDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    private Collection $vendorConversationMessageDTO;

    private Collection $vendorConversationVendorDTO;
}

<?php

namespace App\DTO\Vendor;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\AttachmentTrait;

final class VendorMediaDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    use AttachmentTrait;
}

<?php

namespace App\Dto\Vendor;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\AttachmentTrait;

final class VendorMediaDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    use AttachmentTrait;
}

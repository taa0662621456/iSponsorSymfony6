<?php

namespace App\Dto\Vendor;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\VendorLanguageTrait;

final class VendorProfileDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    use VendorLanguageTrait;
}

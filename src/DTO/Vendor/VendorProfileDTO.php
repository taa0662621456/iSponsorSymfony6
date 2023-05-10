<?php

namespace App\DTO\Vendor;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Entity\VendorLanguageTrait;

final class VendorProfileDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    use VendorLanguageTrait;
}

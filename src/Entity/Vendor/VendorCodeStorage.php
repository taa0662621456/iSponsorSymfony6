<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorCodeStorageInterface;

#[ORM\Index(columns: ['phone'], name: 'sms_code_send_storage_idx')]

#[ORM\Entity]
class VendorCodeStorage extends ObjectSuperEntity implements ObjectInterface, VendorCodeStorageInterface
{
    #[ORM\Column(name: 'phone', type: 'string')]
    protected string $phone;

    #[ORM\Column(type: 'smallint')]
    private int $code;

    #[ORM\Column(name: 'is_login', type: 'boolean')]
    protected bool $isLogin;
}

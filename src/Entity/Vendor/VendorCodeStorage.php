<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorCodeStorageInterface;

#[ORM\Index(columns: ['phone'], name: 'sms_code_send_storage_idx')]

#[ORM\Entity]
class VendorCodeStorage extends RootEntity implements ObjectInterface, VendorCodeStorageInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(name: 'phone', type: 'string')]
    protected string $phone;

    #[ORM\Column(type: 'smallint')]
    private int $code;

    #[ORM\Column(name: 'is_login', type: 'boolean')]
    protected bool $isLogin;
}

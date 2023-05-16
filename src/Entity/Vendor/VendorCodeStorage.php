<?php

namespace App\Entity\Vendor;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Vendor\VendorCodeStorageInterface;

#[ORM\Index(columns: ['phone'], name: 'sms_code_send_storage_idx')]

#[ORM\Entity]
final class VendorCodeStorage extends ObjectSuperEntity implements ObjectInterface, VendorCodeStorageInterface
{
    #[ORM\Column(name: 'phone', type: 'string')]
    protected string $phone;

    #[ORM\Column(type: 'smallint')]
    private int $code;

    #[ORM\Column(name: 'is_login', type: 'boolean')]
    protected bool $isLogin;

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function isLogin(): bool
    {
        return $this->isLogin;
    }

    public function setIsLogin(bool $isLogin): void
    {
        $this->isLogin = $isLogin;
    }
}

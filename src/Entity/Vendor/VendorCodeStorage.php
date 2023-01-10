<?php

namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'vendor_sms_code_send_storage')]
#[ORM\Index(columns: ['phone'], name: 'sms_code_send_storage_idx')]
#[ORM\HasLifecycleCallbacks]

#
#[ApiResource()]

class VendorCodeStorage
{
    use ObjectBaseTrait;

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

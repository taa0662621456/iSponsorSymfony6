<?php

namespace App\DTO\Vendor;

use App\DTO\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;

final class VendorCodeStorageDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    protected string $phone;

    private int $codeDTO;

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

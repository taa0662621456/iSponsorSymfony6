<?php

namespace App\Entity\Vendor;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="sms_code_send_storage", indexes={
 * @ORM\Index(name="sms_code_send_storage_idx", columns={"phone"})}))
 * @ORM\Entity(repositoryClass="App\Repository\Vendor\VendorCodeStorageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class VendorCodeStorage
{
    use BaseTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="phone")
     */
    protected string $phone;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private int $code;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="is_login")
     */
    protected bool $isLogin;

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return bool
     */
    public function isLogin(): bool
    {
        return $this->isLogin;
    }

    /**
     * @param bool $isLogin
     */
    public function setIsLogin(bool $isLogin): void
    {
        $this->isLogin = $isLogin;
    }


}

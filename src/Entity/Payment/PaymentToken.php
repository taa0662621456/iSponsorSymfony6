<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use Payum\Core\Security\Util\Random;
use App\Interface\Object\ObjectInterface;
use App\Interface\Payment\PaymentTokenInterface;

#[ORM\Entity]
final class PaymentToken extends ObjectSuperEntity implements ObjectInterface, PaymentTokenInterface
{
    protected string $hash;

    protected ?ObjectSuperEntity $details;

    protected ?string $afterUrl;

    protected ?string $targetUrl;

    protected ?string $gatewayName;

    public function __construct()
    {
        $this->hash = Random::generateToken();
    }

    public function getId(): int
    {
        return $this->hash;
    }

    public function setDetails($details): void
    {
        $this->details = $details;
    }

    public function getDetails(): ?ObjectSuperEntity
    {
        return $this->details;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function setHash($hash): void
    {
        $this->hash = $hash;
    }

    public function getTargetUrl(): string
    {
        return $this->targetUrl;
    }

    public function setTargetUrl($targetUrl): void
    {
        $this->targetUrl = $targetUrl;
    }

    public function getAfterUrl(): ?string
    {
        return $this->afterUrl;
    }

    public function setAfterUrl($afterUrl): void
    {
        $this->afterUrl = $afterUrl;
    }

    public function getGatewayName(): string
    {
        return $this->gatewayName;
    }

    public function setGatewayName($gatewayName): void
    {
        $this->gatewayName = $gatewayName;
    }
}

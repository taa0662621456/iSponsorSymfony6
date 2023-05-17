<?php

namespace App\Dto\Payment;

use App\Dto\Abstraction\ObjectDTO;
use App\Interface\Object\ObjectApiResourceInterface;


final class PaymentTokenDTO extends ObjectDTO implements ObjectApiResourceInterface
{
    protected string $hash;

    protected ?object $details;

    protected ?string $afterUrl;

    protected ?string $targetUrl;

    protected ?string $gatewayName;

    public function getId(): int
    {
        return $this->hash;
    }

    public function setDetails($details): void
    {
        $this->details = $details;
    }

    public function getDetails(): ?object
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

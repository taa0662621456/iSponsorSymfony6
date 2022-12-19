<?php


namespace App\Entity\Payment;

use Payum\Core\Security\Util\Random;

class PaymentSecurityToken implements PaymentSecurityTokenInterface
{
    /** @var string */
    protected string $hash;

    /** @var object|null */
    protected ?object $details;

    /** @var string|null */
    protected ?string $afterUrl;

    /** @var string|null */
    protected ?string $targetUrl;

    /** @var string|null */
    protected ?string $gatewayName;

    public function __construct()
    {
        $this->hash = Random::generateToken();
    }

    public function getId(): string
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

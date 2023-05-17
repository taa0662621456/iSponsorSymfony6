<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use Payum\Core\Security\Util\Random;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentTokenInterface;

#[ORM\Entity]
class PaymentToken extends ObjectSuperEntity implements ObjectInterface, PaymentTokenInterface
{
    protected string $hash;

    protected ?ObjectSuperEntity $details;

    protected ?string $afterUrl;

    protected ?string $targetUrl;

    protected ?string $gatewayName;

    public function __construct()
    {
        parent::__construct();
        $this->hash = Random::generateToken();
    }

    public function getId(): int
    {
        return $this->hash;
    }
}

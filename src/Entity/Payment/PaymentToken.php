<?php

namespace App\Entity\Payment;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Security\Util\Random;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentTokenInterface;

#[ORM\Entity]
class PaymentToken extends RootEntity implements ObjectInterface, PaymentTokenInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\OneToOne(inversedBy: "paymentToken", targetEntity: Payment::class)]
    private Payment $paymentToken;

    protected string $hash;

    protected ?RootEntity $details;

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

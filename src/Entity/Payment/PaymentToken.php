<?php

namespace App\Entity\Payment;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Security\Util\Random;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentTokenInterface;

#[ORM\Entity]
class PaymentToken extends RootEntity implements ObjectInterface, PaymentTokenInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'payment')]
    private ObjectProperty $objectProperty;


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

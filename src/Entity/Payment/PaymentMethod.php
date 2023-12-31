<?php

namespace App\Entity\Payment;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentMethodInterface;

#[ORM\Entity]
class PaymentMethod extends RootEntity implements ObjectInterface, PaymentMethodInterface
{

    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'payment')]
    private ObjectProperty $objectProperty;


    #[ORM\Column(type: 'string', nullable: true)]
    private mixed $code;

    #[ORM\Column(type: 'string', nullable: true)]
    private mixed $fallbackLocale;

    /*    #[ORM\Embedded(class: 'GatewayConfig')]
        private mixed $gatewayConfig;*/
}

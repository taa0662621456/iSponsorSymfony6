<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentMethodInterface;

#[ORM\Entity]
class PaymentMethod extends ObjectSuperEntity implements ObjectInterface, PaymentMethodInterface
{
    #[ORM\Column(type: 'string')]
    private mixed $code;

    #[ORM\Column(type: 'boolean')]
    private mixed $enabled;

    #[ORM\Column(type: 'string')]
    private mixed $currentLocale;

    #[ORM\Column(type: 'string')]
    private mixed $fallbackLocale;

    #[ORM\Column(type: 'string')]
    private mixed $name;

    #[ORM\Column(type: 'string')]
    private mixed $description;

    #[ORM\Column(type: 'string')]
    private mixed $instructions;

    #[ORM\ManyToMany(targetEntity: 'Channel')]
    private mixed $channels;

    #[ORM\Embedded(class: 'GatewayConfig')]
    private mixed $gatewayConfig;


}

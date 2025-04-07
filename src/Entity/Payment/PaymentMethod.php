<?php

namespace App\Entity\Payment;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentMethodInterface;

#[ORM\Entity]
class PaymentMethod extends RootEntity implements ObjectInterface, PaymentMethodInterface
{

    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Column(type: 'string', nullable: true)]
    private mixed $code;

    #[ORM\Column(type: 'string', nullable: true)]
    private mixed $fallbackLocale;

    #[ORM\ManyToOne(targetEntity: Payment::class, inversedBy: "paymentMethod")]
    private Payment $paymentMethod;



}

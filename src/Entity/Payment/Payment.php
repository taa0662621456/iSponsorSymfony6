<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentInterface;
use Payum\Core\Model\CreditCard;

/**
 * @method array getDetails()
 */
#[ORM\Entity]
class Payment extends ObjectSuperEntity implements ObjectInterface, PaymentInterface
{
    #[ORM\Column(type: 'string')]
    private string $number;

    #[ORM\Column(type: 'string')]
    private string $description;

    #[ORM\Column(type: 'string')]
    private string $clientEmail;

    #[ORM\Column(type: 'integer')]
    private int $totalAmount;

    #[ORM\Column(type: 'string')]
    private string $currencyCode;

    #[ORM\Embedded(class: 'CreditCard')]
    private ?CreditCard $creditCard;

    #[ORM\Column(type: 'json')]
    private ?array $details;

    #[ORM\Column(type: 'string')]
    private ?string $clientId;
}

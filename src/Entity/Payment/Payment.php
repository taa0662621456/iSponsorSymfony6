<?php

namespace App\Entity\Payment;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentInterface;

/**
 * @method array getPaymentDetail()
 */
#[ORM\Entity]
class Payment extends RootEntity implements ObjectInterface, PaymentInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'payment')]
    private ObjectProperty $objectProperty;


    #[ORM\Column(type: 'string')]
    private string $paymentNumber;

    #[ORM\Column(type: 'string')]
    private string $paymentDescription;

    #[ORM\Column(type: 'string')]
    private string $paymentCustomerEmail;

    #[ORM\Column(type: 'integer')]
    private int $paymentAmount;

    #[ORM\Column(type: 'string')]
    private string $paymentCurrencyCode;

    /*    #[ORM\Embedded(class: 'CreditCard')]
        private ?CreditCard $creditCard;*/

    #[ORM\Column(type: 'json')]
    private ?array $paymentDetail;

    #[ORM\Column(type: 'string')]
    private ?string $paymentCustomerId;

    #[ORM\ManyToOne(targetEntity: PaymentGateway::class, inversedBy: "paymentGateway")]
    private PaymentGateway $paymentGateway;

    #[ORM\ManyToOne(targetEntity: PaymentMethod::class, inversedBy: "paymentMethod")]
    private PaymentMethod $paymentMethod;

    #[ORM\OneToOne(mappedBy: "paymentToken", targetEntity: PaymentToken::class)]
    private PaymentToken $paymentToken;

    #[ORM\OneToOne(mappedBy: "paymentEnUs", targetEntity: PaymentEnUs::class)]
    private PaymentEnUs $paymentDetailsEnUs;

    /**
     * @return PaymentGateway
     */
    public function getPaymentGateway(): PaymentGateway
    {
        return $this->paymentGateway;
    }

    /**
     * @param PaymentGateway $paymentGateway
     */
    public function setPaymentGateway(PaymentGateway $paymentGateway): void
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod(): PaymentMethod
    {
        return $this->paymentMethod;
    }

    /**
     * @param PaymentMethod $paymentMethod
     */
    public function setPaymentMethod(PaymentMethod $paymentMethod): void
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return PaymentToken
     */
    public function getPaymentToken(): PaymentToken
    {
        return $this->paymentToken;
    }

    /**
     * @param PaymentToken $paymentToken
     */
    public function setPaymentToken(PaymentToken $paymentToken): void
    {
        $this->paymentToken = $paymentToken;
    }

    /**
     * @return PaymentEnUs
     */
    public function getPaymentDetailsEnUs(): PaymentEnUs
    {
        return $this->paymentDetailsEnUs;
    }

    /**
     * @param PaymentEnUs $paymentDetailsEnUs
     */
    public function setPaymentDetailsEnUs(PaymentEnUs $paymentDetailsEnUs): void
    {
        $this->paymentDetailsEnUs = $paymentDetailsEnUs;
    }



}

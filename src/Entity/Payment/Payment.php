<?php

namespace App\Entity\Payment;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentInterface;

/**
 * @method array getPaymentDetail()
 */
#[ORM\Entity]
class Payment extends RootEntity implements ObjectInterface, PaymentInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
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

    #[ORM\Column(type: 'json')]
    private ?array $paymentDetail;

    #[ORM\Column(type: 'string')]
    private ?string $paymentCustomerId;

    #[ORM\ManyToOne(targetEntity: PaymentGateway::class, inversedBy: "paymentGateway")]
    private PaymentGateway $paymentGateway;

    #[ORM\OneToMany(mappedBy: "paymentMethod", targetEntity: PaymentMethod::class)]
    private PaymentMethod $paymentMethod;

    #[ORM\OneToOne(mappedBy: "paymentToken", targetEntity: PaymentToken::class)]
    private PaymentToken $paymentToken;

    #[ORM\OneToOne(mappedBy: "paymentEnUs", targetEntity: PaymentEnUs::class)]
    private PaymentEnUs $paymentEnUs;

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
    public function getPaymentEnUs(): PaymentEnUs
    {
        return $this->paymentEnUs;
    }

    /**
     * @param PaymentEnUs $paymentEnUs
     */
    public function setPaymentEnUs(PaymentEnUs $paymentEnUs): void
    {
        $this->paymentEnUs = $paymentEnUs;
    }



}

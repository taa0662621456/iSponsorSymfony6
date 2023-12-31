<?php

namespace App\Entity\Payment;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Security\CypherInterface;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentGatewayInterface;

#[ORM\Entity]
class PaymentGateway extends RootEntity implements ObjectInterface, PaymentGatewayInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'payment')]
    private ObjectProperty $objectProperty;


    protected string $factoryName;

    protected string $gatewayName;

    protected array $config;

    protected array $decryptedConfig;

    #[ORM\OneToMany(mappedBy: "paymentGateway", targetEntity: Payment::class)]
    private Collection $paymentGateway;

    public function __construct()
    {
        parent::__construct();
        $this->config = [];
        $this->decryptedConfig = [];
        $this->paymentGateway = new ArrayCollection();

    }

    public function getConfig(): array
    {
        if (isset($this->config['encrypted'])) {
            return $this->decryptedConfig;
        }

        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
        $this->decryptedConfig = $config;
    }

    public function decrypt(CypherInterface $cypher): void
    {
        if (empty($this->config['encrypted'])) {
            return;
        }

        foreach ($this->config as $name => $value) {
            if ('encrypted' == $name || \is_bool($value)) {
                $this->decryptedConfig[$name] = $value;

                continue;
            }

            $this->decryptedConfig[$name] = $cypher->decrypt($value);
        }
    }

    public function encrypt(CypherInterface $cypher): void
    {
        $this->decryptedConfig['encrypted'] = true;

        foreach ($this->decryptedConfig as $name => $value) {
            if ('encrypted' == $name || \is_bool($value)) {
                $this->config[$name] = $value;

                continue;
            }

            $this->config[$name] = $cypher->encrypt($value);
        }
    }

    /**
     * @return Collection
     */
    public function getPaymentGateway(): Collection
    {
        return $this->paymentGateway;
    }

    /**
     * @param Collection $paymentGateway
     */
    public function setPaymentGateway(Collection $paymentGateway): void
    {
        $this->paymentGateway = $paymentGateway;
    }


}

<?php

namespace App\Entity\Payment;

use App\Entity\ObjectSuperEntity;
use App\Entity\ObjectBaseTrait;
use App\Interface\Object\ObjectInterface;
use App\Interface\Payment\PaymentGatewayInterface;
use App\Repository\PaymentGatewayRepository;
use Doctrine\ORM\Mapping as ORM;
use Payum\Core\Security\CypherInterface;

#[ORM\Table(name: 'payment_gateway')]
#[ORM\Index(columns: ['slug'], name: 'payment_gateway_idx')]
#[ORM\Entity(repositoryClass: PaymentGatewayRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class PaymentGateway extends ObjectSuperEntity implements ObjectInterface, PaymentGatewayInterface
{

    protected string $factoryName;

    protected string $gatewayName;

    protected array $config;

    /**
     * Note: This should not be persisted to database.
     */
    protected array $decryptedConfig;

    public function __construct()
    {
        $this->config = [];
        $this->decryptedConfig = [];
    }


    public function getFactoryName(): string
    {
        return $this->factoryName;
    }


    public function setFactoryName($factoryName): void
    {
        $this->factoryName = $factoryName;
    }

    public function getGatewayName(): string
    {
        return $this->gatewayName;
    }

    public function setGatewayName(string $gatewayName): void
    {
        $this->gatewayName = $gatewayName;
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
            if ('encrypted' == $name || is_bool($value)) {
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
            if ('encrypted' == $name || is_bool($value)) {
                $this->config[$name] = $value;

                continue;
            }

            $this->config[$name] = $cypher->encrypt($value);
        }
    }
}

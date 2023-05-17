<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use Payum\Core\Security\CypherInterface;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Payment\PaymentGatewayInterface;

#[ORM\Entity]
class PaymentGateway extends ObjectSuperEntity implements ObjectInterface, PaymentGatewayInterface
{
    protected string $factoryName;

    protected string $gatewayName;

    protected array $config;

    protected array $decryptedConfig;

    public function __construct()
    {
        parent::__construct();
        $this->config = [];
        $this->decryptedConfig = [];
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
}

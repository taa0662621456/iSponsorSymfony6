<?php

namespace App\Entity\Payment;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use Payum\Core\Security\CypherInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'payment_gateway')]
#[ORM\Index(columns: ['slug'], name: 'payment_gateway_idx')]
#[ORM\Entity(repositoryClass: PaymentGatewayRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class PaymentGateway
{
    use BaseTrait;

    /**
     * @var string
     */
    protected $factoryName;

    /**
     * @var string
     */
    protected $gatewayName;

    /**
     * @var array
     */
    protected $config;

    /**
     * Note: This should not be persisted to database
     *
     * @var array
     */
    protected $decryptedConfig;

    public function __construct()
    {
        $this->config = [];
        $this->decryptedConfig = [];
    }

    /**
     * {@inheritDoc}
     */
    public function getFactoryName()
    {
        return $this->factoryName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFactoryName($factoryName)
    {
        $this->factoryName = $factoryName;
    }

    /**
     * @return string
     */
    public function getGatewayName()
    {
        return $this->gatewayName;
    }

    /**
     * @param string $gatewayName
     */
    public function setGatewayName($gatewayName)
    {
        $this->gatewayName = $gatewayName;
    }

    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        if (isset($this->config['encrypted'])) {
            return $this->decryptedConfig;
        }

        return $this->config;
    }

    /**
     * {@inheritDoc}
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
        $this->decryptedConfig = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function decrypt(CypherInterface $cypher)
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

    /**
     * {@inheritdoc}
     */
    public function encrypt(CypherInterface $cypher)
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

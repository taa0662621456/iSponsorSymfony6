<?php

namespace App\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Payment\PaymentMethodInterface;

#[ORM\Entity]
final class PaymentMethod extends ObjectSuperEntity implements ObjectInterface, PaymentMethodInterface
{
    public function getGatewayConfig()
    {
        // TODO: Implement getGatewayConfig() method.
    }

    public function setCode(mixed $code)
    {
        // TODO: Implement setCode() method.
    }

    public function setEnabled(mixed $enabled)
    {
        // TODO: Implement setEnabled() method.
    }

    public function setCurrentLocale(mixed $localeCode)
    {
        // TODO: Implement setCurrentLocale() method.
    }

    public function setFallbackLocale(mixed $localeCode)
    {
        // TODO: Implement setFallbackLocale() method.
    }

    public function setName(mixed $name)
    {
        // TODO: Implement setName() method.
    }

    public function setDescription(mixed $description)
    {
        // TODO: Implement setDescription() method.
    }

    public function setInstructions(mixed $instructions)
    {
        // TODO: Implement setInstructions() method.
    }

    public function addChannel(mixed $channel)
    {
        // TODO: Implement addChannel() method.
    }
}

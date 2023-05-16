<?php

namespace App\Entity\Currency;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Currency\CurrencyInterface;

#[ORM\Entity]
final class Currency extends ObjectSuperEntity implements ObjectInterface, CurrencyInterface
{
    public function setCode(mixed $currencyCode): void
    {
        // TODO: Implement setCode() method.
    }
}

<?php

namespace App\Entity\Currency;

use App\Entity\ObjectSuperEntity;
use App\Interface\Currency\CurrencyInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Currency\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'currency')]
#[ORM\Index(columns: ['slug'], name: 'currency_idx')]
#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Currency extends ObjectSuperEntity implements ObjectInterface, CurrencyInterface
{
    public function setCode(mixed $currencyCode): void
    {
        // TODO: Implement setCode() method.
    }
}

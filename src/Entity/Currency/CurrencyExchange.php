<?php

namespace App\Entity\Currency;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Interface\Currency\CurrencyExchangeInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\CurrencyExchangeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'currency_exchange')]
#[ORM\Index(columns: ['slug'], name: 'currency_exchange_idx')]
#[ORM\Entity(repositoryClass: CurrencyExchangeRepository::class)]
#[ORM\HasLifecycleCallbacks]

#[ApiResource(mercure: true)]
final class CurrencyExchange extends ObjectSuperEntity implements ObjectInterface, CurrencyExchangeInterface
{
    protected $currencySource;

    protected $currencyTarget;

    protected $currencyRatio;
}

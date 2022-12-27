<?php

namespace App\Entity\Currency;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'currency_exchange')]
#[ORM\Index(columns: ['slug'], name: 'currency_exchange_idx')]
#[ORM\Entity(repositoryClass: CurrencyExchangeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(mercure: true)]
class CurrencyExchange
{
    use BaseTrait;

    protected $currencySource;

    protected $currencyTarget;

    protected $currencyRatio;

}

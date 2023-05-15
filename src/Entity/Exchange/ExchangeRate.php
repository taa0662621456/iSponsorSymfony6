<?php

namespace App\Entity\Exchange;

use App\Entity\ObjectSuperEntity;
use App\Interface\Exchange\ExchangeRateInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Exchange\ExchangeRateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'exchange_rate')]
#[ORM\Index(columns: ['slug'], name: 'exchange_rate_idx')]
#[ORM\Entity(repositoryClass: ExchangeRateRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class ExchangeRate extends ObjectSuperEntity implements ObjectInterface, ExchangeRateInterface
{

}

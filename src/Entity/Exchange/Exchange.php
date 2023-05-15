<?php

namespace App\Entity\Exchange;

use App\Entity\ObjectSuperEntity;
use App\Interface\Exchange\ExchangeInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Exchange\ExchangeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'exchange')]
#[ORM\Index(columns: ['slug'], name: 'exchange_idx')]
#[ORM\Entity(repositoryClass: ExchangeRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class Exchange extends ObjectSuperEntity implements ObjectInterface, ExchangeInterface
{

}


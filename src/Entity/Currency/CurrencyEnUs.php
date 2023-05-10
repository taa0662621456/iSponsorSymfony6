<?php

namespace App\Entity\Currency;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\CurrencyEnRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'currency_en')]
#[ORM\Index(columns: ['slug'], name: 'currency_en_idx')]
#[ORM\Entity(repositoryClass: CurrencyEnRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class CurrencyEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{

}

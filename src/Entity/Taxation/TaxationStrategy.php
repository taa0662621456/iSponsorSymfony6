<?php

namespace App\Entity\Taxation;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationStrategyInterface;
use App\Repository\Taxation\TaxationStrategyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation_strategy')]
#[ORM\Index(columns: ['slug'], name: 'taxation_strategy_idx')]
#[ORM\Entity(repositoryClass: TaxationStrategyRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class TaxationStrategy extends ObjectSuperEntity implements ObjectInterface, TaxationStrategyInterface
{

}

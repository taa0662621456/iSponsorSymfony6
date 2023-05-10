<?php

namespace App\Entity\Taxation;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationRateValueInterface;
use App\Repository\Taxation\TaxationRateValueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation_rate_value')]
#[ORM\Index(columns: ['slug'], name: 'taxation_rate_value_idx')]
#[ORM\Entity(repositoryClass: TaxationRateValueRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class TaxationRateValue extends ObjectSuperEntity implements ObjectInterface, TaxationRateValueInterface
{
}

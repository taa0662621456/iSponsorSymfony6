<?php

namespace App\Entity\Taxation;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationInterface;
use App\Repository\Taxation\TaxationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation')]
#[ORM\Index(columns: ['slug'], name: 'taxation_idx')]
#[ORM\Entity(repositoryClass: TaxationRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Taxation extends ObjectSuperEntity implements ObjectInterface, TaxationInterface
{
}

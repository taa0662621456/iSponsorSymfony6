<?php

namespace App\Entity\Taxation;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\TaxationEnUsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation')]
#[ORM\Index(columns: ['slug'], name: 'taxation_idx')]
#[ORM\Entity(repositoryClass: TaxationEnUsRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class TaxationEnUs extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

<?php

namespace App\Entity\Taxation;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationZoneInterface;
use App\Repository\Taxation\TaxationZoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation_zone')]
#[ORM\Index(columns: ['slug'], name: 'taxation_zone_idx')]
#[ORM\Entity(repositoryClass: TaxationZoneRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class TaxationZone extends ObjectSuperEntity implements ObjectInterface, TaxationZoneInterface
{

}

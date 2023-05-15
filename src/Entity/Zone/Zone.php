<?php

namespace App\Entity\Zone;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Zone\ZoneFactoryInterface;
use App\Repository\Zone\ZoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'zone')]
#[ORM\Index(columns: ['slug'], name: 'zone_idx')]
#[ORM\Entity(repositoryClass: ZoneRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class Zone extends ObjectSuperEntity implements ObjectInterface, ZoneFactoryInterface
{

}

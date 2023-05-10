<?php

namespace App\Entity\Property;

use App\Entity\ObjectSuperEntity;

use App\Interface\Object\ObjectInterface;
use App\Interface\Property\PropertyInterface;
use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'property')]
#[ORM\Index(columns: ['slug'], name: 'property_idx')]
#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Property extends ObjectSuperEntity implements ObjectInterface, PropertyInterface
{

}

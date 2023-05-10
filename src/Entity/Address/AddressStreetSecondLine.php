<?php

namespace App\Entity\Address;

use App\Entity\ObjectSuperEntity;
use App\Interface\Address\AddressStreetSecondLineInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Address\AddressStreetSecondLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'address_street_second_line')]
#[ORM\Index(columns: ['slug'], name: 'address_street_second_line_idx')]
#[ORM\Entity(repositoryClass: AddressStreetSecondLineRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class AddressStreetSecondLine extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressStreetSecondLineInterface
{

}

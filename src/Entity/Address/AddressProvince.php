<?php

namespace App\Entity\Address;

use App\Entity\ObjectSuperEntity;
use App\Interface\Address\AddressProvinceInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Address\AddressRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_province')]
#[ORM\Index(columns: ['slug'], name: 'address_province_idx')]
#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class AddressProvince extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressProvinceInterface
{

}

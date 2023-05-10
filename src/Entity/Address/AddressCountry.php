<?php

namespace App\Entity\Address;

use App\Entity\ObjectSuperEntity;
use App\Entity\ObjectBaseTrait;
use App\Interface\Address\AddressCountryInterface;
use App\Interface\Object\ObjectApiResourceInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Address\AddressCountryRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'address_country')]
#[ORM\Index(columns: ['slug'], name: 'address_country_idx')]
#[ORM\Entity(repositoryClass: AddressCountryRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class AddressCountry extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressCountryInterface
{
    public function getCode()
    {
        // TODO: Implement getCode() method.
    }

    public function getProvinces()
    {
        // TODO: Implement getProvinces() method.
    }
}

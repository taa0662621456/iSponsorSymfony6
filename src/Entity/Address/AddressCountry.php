<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Address\AddressCountryInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Entity]
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

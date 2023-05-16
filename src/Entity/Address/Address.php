<?php

namespace App\Entity\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Address\AddressInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Entity]
final class Address extends ObjectSuperEntity implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
    public function setFirstName(mixed $first_name)
    {
        // TODO: Implement setFirstName() method.
    }

    public function setLastName(mixed $last_name)
    {
        // TODO: Implement setLastName() method.
    }

    public function setPhoneNumber(mixed $phone_number)
    {
        // TODO: Implement setPhoneNumber() method.
    }

    public function setCompany(mixed $company)
    {
        // TODO: Implement setCompany() method.
    }

    public function setStreet(mixed $street)
    {
        // TODO: Implement setStreet() method.
    }

    public function setCity(mixed $city)
    {
        // TODO: Implement setCity() method.
    }

    public function setPostcode(mixed $postcode)
    {
        // TODO: Implement setPostcode() method.
    }

    public function setCountryCode(mixed $country_code)
    {
        // TODO: Implement setCountryCode() method.
    }
}

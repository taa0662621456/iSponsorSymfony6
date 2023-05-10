<?php

namespace App\Interface\Address;

interface AddressInterface
{

    public function setFirstName(mixed $first_name);

    public function setLastName(mixed $last_name);

    public function setPhoneNumber(mixed $phone_number);

    public function setCompany(mixed $company);

    public function setStreet(mixed $street);

    public function setCity(mixed $city);

    public function setPostcode(mixed $postcode);

    public function setCountryCode(mixed $country_code);
}

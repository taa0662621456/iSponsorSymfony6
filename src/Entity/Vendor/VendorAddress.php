<?php

namespace App\Entity\Vendor;

use App\Embeddable\Address\AddressProvince;
use App\Embeddable\Address\AddressBuilding;
use App\Embeddable\Address\AddressStreet;
use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorInterface;

#[ORM\Entity]
class VendorAddress extends RootEntity implements ObjectInterface, VendorInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;


    #[ORM\Embedded(class: "AddressBuilding")]
    private AddressBuilding $building;

    #[ORM\Embedded(class: "AddressRegion")]
    private AddressStreet $region;

    #[ORM\Embedded(class: "AddressStreet")]
    private AddressProvince $street;

}

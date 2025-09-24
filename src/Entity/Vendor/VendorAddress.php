<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\Address\Address;
use App\Entity\Embeddable\Address\AddressBuilding;
use App\Entity\Embeddable\Address\AddressProvince;
use App\Entity\Embeddable\Address\AddressStreet;
use App\Entity\Embeddable\ObjectProperty;
use App\Entity\Embeddable\Vendor\AddressRegion;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectInterface;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Vendor\VendorInterface;

#[ORM\Entity]
class VendorAddress extends RootEntity implements ObjectInterface, VendorInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


    #[ORM\Embedded(class: AddressBuilding::class)]
    private AddressBuilding $building;

    #[ORM\Embedded(class: AddressStreet::class)]
    private AddressStreet $region;

    #[ORM\Embedded(class: AddressProvince::class)]
    private AddressProvince $street;

    public function __construct()
    {
        parent::__construct();
        $this->objectProperty = new ObjectProperty();
    }

    /**
     * @return ObjectProperty
     */
    public function getObjectProperty(): ObjectProperty
    {
        return $this->objectProperty;
    }

    /**
     * @param ObjectProperty $objectProperty
     */
    public function setObjectProperty(ObjectProperty $objectProperty): void
    {
        $this->objectProperty = $objectProperty;
    }



}
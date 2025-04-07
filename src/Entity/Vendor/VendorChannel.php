<?php

namespace App\Entity\Vendor;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Vendor\VendorChannelInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class VendorChannel extends RootEntity implements ObjectInterface, VendorChannelInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;


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

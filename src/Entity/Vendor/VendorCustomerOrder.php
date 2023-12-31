<?php

namespace App\Entity\Vendor;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Storage\StorageInterface;

#[ORM\Entity]
class VendorCustomerOrder extends RootEntity implements ObjectInterface, StorageInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'vendor')]
    private ObjectProperty $objectProperty;
}

<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Address extends RootEntity implements AddressInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'address', type: 'string', unique: false, nullable: true, options: ['default' => 'Address'])]
    private string $address = 'Address';
}

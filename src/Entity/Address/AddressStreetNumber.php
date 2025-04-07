<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressStreetInterface;
use App\EntityInterface\Address\AddressStreetNumberInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressStreetNumber extends RootEntity implements AddressStreetNumberInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressStreetNumber', type: 'integer', unique: false, nullable: true, options: ['default' => 00000])]
    private int $addressStreetNumber = 0000;
}

<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressStreetLineInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressStreetLine extends RootEntity implements AddressStreetLineInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressStreetLine', type: 'string', unique: false, nullable: true, options: ['default' => 00000])]
    private string $addressStreetLine = 'StreetLine';
}

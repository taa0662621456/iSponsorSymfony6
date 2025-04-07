<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressStreetLineInterface;
use App\EntityInterface\Address\AddressStreetSecondLineInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressStreetSecondLine extends RootEntity implements AddressStreetSecondLineInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressStreetSecondLine', type: 'string', unique: false, nullable: true, options: ['default' => 00000])]
    private string $addressStreetSecondLine = 'StreetSecondLine';
}

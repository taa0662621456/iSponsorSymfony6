<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressStreetInterface;
use App\EntityInterface\Address\AddressStreetTypeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressStreetType extends RootEntity implements AddressStreetTypeInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressStreetType', type: 'string', unique: false, nullable: true, options: ['default' => 'StreetType'])]
    private string $addressStreetType = 'StreetType';
}

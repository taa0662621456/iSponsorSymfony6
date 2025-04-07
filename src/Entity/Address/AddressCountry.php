<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressCityInterface;
use App\EntityInterface\Address\AddressStreetLineInterface;
use App\EntityInterface\Address\AddressStreetSecondLineInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressCountry extends RootEntity implements AddressCityInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressCountry', type: 'string', unique: false, nullable: true, options: ['default' => 'Country'])]
    private string $addressCountry = 'Country';
}

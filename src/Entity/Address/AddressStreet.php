<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressStreetInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressStreet extends RootEntity implements AddressStreetInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressStreet', type: 'string', unique: false, nullable: true, options: ['default' => 'Street'])]
    private string $addressStreet = 'Street';
}
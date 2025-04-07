<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressCityInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressCity extends RootEntity implements AddressCityInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressCity', type: 'string', unique: false, nullable: true, options: ['default' => 'City'])]
    private string $addressCity = 'City';
}

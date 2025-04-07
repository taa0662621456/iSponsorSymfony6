<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressZipcodeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressZipcode extends RootEntity implements AddressZipcodeInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressZipcode', type: 'integer', unique: false, nullable: true, options: ['default' => 00000])]
    private int $addressZipcode = 00000;
}

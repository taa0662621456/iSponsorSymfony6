<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressCodeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressCode extends RootEntity implements AddressCodeInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressCode', type: 'string', unique: false, nullable: true, options: ['default' => 'Code'])]
    private string $addressCity = 'Code';
}
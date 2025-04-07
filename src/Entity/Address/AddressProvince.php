<?php

namespace App\Entity\Address;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Address\AddressProvinceInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AddressProvince extends RootEntity implements AddressProvinceInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    #[ORM\Column(name: 'addressProvince', type: 'string', unique: false, nullable: true, options: ['default' => 00000])]
    private string $addressProvince = 'Province';
}

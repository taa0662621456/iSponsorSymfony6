<?php

namespace App\Embeddable\Address;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Address\AddressStreetInterface;

#[ORM\Embeddable]
class AddressStreet implements AddressStreetInterface
{
    #[ORM\Column(type: "string")]
    private $type;
}

<?php

namespace App\Embeddable\Address;

use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Address\AddressInterface;
use App\Interface\Object\ObjectApiResourceInterface;

#[ORM\Embeddable]
class AddressBuilding implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
    #[ORM\Column(type: "integer")]
    private int $number;

    #[ORM\Column(type: "string")]
    private $type;






}

<?php

namespace App\Entity\Embeddable\Address;

use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Object\ObjectApiResourceInterface;

#[ORM\Embeddable]
class AddressBuilding implements ObjectInterface, ObjectApiResourceInterface, AddressInterface
{
    #[ORM\Column(type: "integer")]
    private int $number;

    #[ORM\Column(type: "string")]
    private $type;






}
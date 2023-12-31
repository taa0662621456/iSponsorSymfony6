<?php

namespace App\Entity\Property;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTitleInterface;

#[ORM\Entity]
class PropertyEnUs extends RootEntity implements ObjectInterface, ObjectTitleInterface
{
}

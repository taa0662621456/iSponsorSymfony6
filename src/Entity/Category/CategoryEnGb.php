<?php

namespace App\Entity\Category;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;

#[ORM\Entity]
final class CategoryEnGb extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

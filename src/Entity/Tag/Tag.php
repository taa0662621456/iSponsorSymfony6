<?php

namespace App\Entity\Tag;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Tag\TagInterface;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
class Tag extends RootEntity implements ObjectInterface, TagInterface
{
}

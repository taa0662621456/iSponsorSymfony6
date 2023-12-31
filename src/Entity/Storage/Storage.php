<?php

namespace App\Entity\Storage;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Storage\StorageInterface;

#[ORM\Entity]
class Storage extends RootEntity implements ObjectInterface, StorageInterface
{
    // TODO: склад товаров
}

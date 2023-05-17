<?php

namespace App\Entity\Storage;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Storage\StorageInterface;

#[ORM\Entity]
class Storage extends ObjectSuperEntity implements ObjectInterface, StorageInterface
{
    // TODO: склад товаров
}

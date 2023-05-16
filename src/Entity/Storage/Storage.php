<?php

namespace App\Entity\Storage;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Storage\StorageInterface;

#[ORM\Entity]
final class Storage extends ObjectSuperEntity implements ObjectInterface, StorageInterface
{
    // TODO: склад товаров
}

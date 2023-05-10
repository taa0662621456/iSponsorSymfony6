<?php

namespace App\Entity\Storage;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Storage\StorageInterface;
use App\Repository\StorageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'storage')]
#[ORM\Index(columns: ['slug'], name: 'storage_idx')]
#[ORM\Entity(repositoryClass: StorageRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class Storage extends ObjectSuperEntity implements ObjectInterface, StorageInterface
{
    // TODO: склад товаров
}

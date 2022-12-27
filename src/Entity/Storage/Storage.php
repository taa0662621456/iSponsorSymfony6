<?php

namespace App\Entity\Storage;

use App\Entity\BaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'storage')]
#[ORM\Index(columns: ['slug'], name: 'storage_idx')]
#[ORM\Entity(repositoryClass: StorageRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
class Storage
{
    use BaseTrait;
    //TODO: склад товаров
}

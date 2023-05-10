<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
#[ORM\Index(columns: ['published'], name: 'idx_published')]
#[ORM\Index(columns: ['slug'], name: 'idx_slug')]

class ObjectSuperEntity
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;
    use ObjectMetaDataTrait;
}

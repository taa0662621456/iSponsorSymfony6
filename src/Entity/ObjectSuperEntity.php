<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\MappedSuperclass]
class ObjectSuperEntity
{
    use ObjectBaseTrait;
    use ObjectMetaDataTrait;
    use ObjectTitleTrait;
}

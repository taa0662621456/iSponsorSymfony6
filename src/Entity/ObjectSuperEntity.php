<?php

namespace App\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\MappedSuperclass]
abstract class ObjectSuperEntity
{
    use ObjectBaseTrait;
    use ObjectMetaDataTrait;
    use ObjectTitleTrait;

    public function __construct()
    {
        $this->slug = Uuid::uuid4();
    }
}

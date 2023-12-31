<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\MappedSuperclass]
abstract class RootEntity
{
    use ObjectBaseTrait;
    use ObjectMetaDataTrait;
    use ObjectTitleTrait;
}

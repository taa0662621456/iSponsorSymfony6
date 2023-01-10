<?php

namespace App\Entity\Module;

use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'module_menu')]
#[ORM\Entity]
class ModuleMenu
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

    public function __construct()
    {
        $t = new DateTime();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestDate = $t->format('Y-m-d H:i:s');
        $this->createdAt = $t->format('Y-m-d H:i:s');
        $this->modifiedAt = $t->format('Y-m-d H:i:s');
        $this->lockedAt = $t->format('Y-m-d H:i:s');
        $this->published = true;
    }
}

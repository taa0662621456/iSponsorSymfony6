<?php

namespace App\Entity\Event;

use App\Embeddable\Object\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Event\EventCategoryInterface;

#[ORM\Entity]
class EventCategory extends RootEntity implements ObjectInterface, EventCategoryInterface
{
    #[ORM\Embedded(class: 'ObjectProperty', columnPrefix: 'event')]
    private ObjectProperty $objectProperty;

}

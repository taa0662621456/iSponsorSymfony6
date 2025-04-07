<?php

namespace App\Entity\Event;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;
use App\EntityInterface\Event\EventCategoryInterface;

#[ORM\Entity]
class EventCategory extends RootEntity implements ObjectInterface, EventCategoryInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

}

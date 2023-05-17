<?php

namespace App\Entity\Event;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Event\EventCategoryInterface;

#[ORM\Entity]
class EventCategory extends ObjectSuperEntity implements ObjectInterface, EventCategoryInterface
{
}

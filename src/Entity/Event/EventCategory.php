<?php

namespace App\Entity\Event;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Event\EventCategoryInterface;

#[ORM\Entity]
final class EventCategory extends ObjectSuperEntity implements ObjectInterface, EventCategoryInterface
{
}

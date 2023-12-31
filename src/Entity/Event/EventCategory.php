<?php

namespace App\Entity\Event;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Event\EventCategoryInterface;

#[ORM\Entity]
class EventCategory extends RootEntity implements ObjectInterface, EventCategoryInterface
{
}

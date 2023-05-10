<?php

namespace App\Entity\Event;

use App\Entity\ObjectSuperEntity;
use App\Interface\Event\EventCategoryInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'event_category')]
#[ORM\Index(columns: ['slug'], name: 'event_category_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]

final class EventCategory extends ObjectSuperEntity implements ObjectInterface, EventCategoryInterface
{
}

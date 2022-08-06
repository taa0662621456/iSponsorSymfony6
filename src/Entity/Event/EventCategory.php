<?php

namespace App\Entity\Event;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Category\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'event_category')]
#[ORM\Index(columns: ['slug'], name: 'event_category_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
class EventCategory
{
    use BaseTrait;
    use ObjectTrait;
}

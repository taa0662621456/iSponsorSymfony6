<?php

namespace App\Entity\Event;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Category\CategoryRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(name: 'event_category')]
#[ORM\Index(columns: ['slug'], name: 'event_category_idx')]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]


class EventCategory
{
    use BaseTrait;
    use ObjectTrait;

    public function __construct()
    {
        $t = new \DateTimeImmutable();
        $this->slug = (string)Uuid::v4();

        $this->lastRequestAt = $t;
        $this->createdAt = $t;
        $this->modifiedAt = $t;
        $this->lockedAt = $t;
        $this->published = true;
    }
}

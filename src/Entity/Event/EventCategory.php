<?php

namespace AppEntity;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * EventCategories
 *
 * @ORM\Table(name="event_categories", indexes={
 *     @ORM\Index(name="event_category_idx", columns={"slug"})})
 * UniqueEntity("slug"), errorPath="slug", message="This slug is already in use!"
 * @ORM\Entity(repositoryClass="App\Repository\Category\CategoryRepository")
 * @ORM\HasLifecycleCallbacks())
 * @ORM\Entity
 */
class EventCategory
{
    use BaseTrait;
    use ObjectTrait;
}

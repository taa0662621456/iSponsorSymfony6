<?php

namespace App\Entity\Taxation;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use App\Entity\ObjectBaseTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation_category')]
#[ORM\Index(columns: ['slug'], name: 'taxation_category_idx')]
#[ORM\Entity(repositoryClass: TaxationCategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource()]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class TaxationCategory
{
    use ObjectBaseTrait;

}

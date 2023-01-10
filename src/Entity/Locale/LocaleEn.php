<?php

namespace App\Entity\Locale;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Repository\Locale\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'localeEn')]
#[ORM\Index(columns: ['slug'], name: 'locale_en_idx')]
#[ORM\Entity(repositoryClass: LocaleRepository::class)]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class LocaleEn
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

}

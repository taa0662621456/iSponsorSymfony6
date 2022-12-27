<?php

namespace App\Entity\Locale;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use JetBrains\PhpStorm\Pure;
use DateTime;

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
    use BaseTrait;
    use ObjectTrait;

}

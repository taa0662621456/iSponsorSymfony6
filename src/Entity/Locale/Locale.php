<?php

namespace App\Entity\Locale;

use ApiPlatform\Doctrine\Odm\Filter\BooleanFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectBaseTrait;
use App\Entity\ObjectTitleTrait;
use App\Interface\Locale\LocaleInterface;
use App\Repository\Locale\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'locale')]
#[ORM\Index(columns: ['slug'], name: 'locale_idx')]
#[ORM\Entity(repositoryClass: LocaleRepository::class)]

#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ['isPublished'])]
class Locale implements LocaleInterface
{
    use ObjectBaseTrait;
    use ObjectTitleTrait;

}

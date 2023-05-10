<?php

namespace App\Entity\Locale;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Object\ObjectTileInterface;
use App\Repository\Locale\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'localeEn')]
#[ORM\Index(columns: ['slug'], name: 'locale_en_idx')]
#[ORM\Entity(repositoryClass: LocaleRepository::class)]

final class LocaleEn extends ObjectSuperEntity implements ObjectInterface, ObjectTileInterface
{
}

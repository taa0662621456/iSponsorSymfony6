<?php

namespace App\Entity\Locale;

use App\Entity\ObjectSuperEntity;
use App\Interface\Locale\LocaleInterface;
use App\Interface\Object\ObjectInterface;
use App\Repository\Locale\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'locale')]
#[ORM\Index(columns: ['slug'], name: 'locale_idx')]
#[ORM\Entity(repositoryClass: LocaleRepository::class)]
final class Locale extends ObjectSuperEntity implements ObjectInterface, LocaleInterface
{

    public function getCode()
    {
        // TODO: Implement getCode() method.
    }
}

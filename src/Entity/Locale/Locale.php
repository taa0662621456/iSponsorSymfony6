<?php

namespace App\Entity\Locale;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\LocaleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Exception;
use JetBrains\PhpStorm\Pure;
use DateTime;

#[ORM\Table(name: 'locale')]
#[ORM\Index(columns: ['slug'], name: 'locale_idx')]
#[ORM\Entity(repositoryClass: LocaleRepository::class)]
class Locale
{
    use BaseTrait;
    use ObjectTrait;

}

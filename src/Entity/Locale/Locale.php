<?php

namespace App\Entity\Locale;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Locale\LocaleInterface;
use App\Interface\Object\ObjectInterface;

#[ORM\Entity]
final class Locale extends ObjectSuperEntity implements ObjectInterface, LocaleInterface
{
    public function getCode()
    {
        // TODO: Implement getCode() method.
    }
}

<?php

namespace App\Entity\Taxation;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationCategoryInterface;

#[ORM\Entity]
final class TaxationCategory extends ObjectSuperEntity implements ObjectInterface, TaxationCategoryInterface
{
}

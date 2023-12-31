<?php

namespace App\Entity\Taxation;

use App\Entity\RootEntity;
use Doctrine\ORM\Mapping as ORM;
use App\Interface\Object\ObjectInterface;
use App\EntityInterface\Taxation\TaxationCategoryInterface;

#[ORM\Entity]
class TaxationCategory extends RootEntity implements ObjectInterface, TaxationCategoryInterface
{
}

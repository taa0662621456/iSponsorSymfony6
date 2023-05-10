<?php

namespace App\Entity\Taxation;

use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Taxation\TaxationCategoryInterface;
use App\Repository\TaxationCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'taxation_category')]
#[ORM\Index(columns: ['slug'], name: 'taxation_category_idx')]
#[ORM\Entity(repositoryClass: TaxationCategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
final class TaxationCategory extends ObjectSuperEntity implements ObjectInterface, TaxationCategoryInterface
{
}

<?php

namespace App\Entity\Currency;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Repository\Currency\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;


#[ORM\Table(name: 'currency')]
#[ORM\Index(columns: ['slug'], name: 'currency_idx')]
#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
class Currency
{
    use ObjectBaseTrait;

}

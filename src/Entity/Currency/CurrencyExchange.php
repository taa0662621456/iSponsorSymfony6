<?php

namespace App\Entity\Currency;

use ApiPlatform\Doctrine\Common\Filter\OrderFilterTrait;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\CurrencyFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'currency_exchange')]
#[ORM\Index(columns: ['slug'], name: 'currency_exchange_idx')]
#[ORM\Entity(repositoryClass: CurrencyExchangeRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    mercure: true,
    operations: [ new GetCollection(), new Get(), new Post(), new Put(), new Delete() ],
    normalizationContext: ['groups' => ['read','list','item']],
    denormalizationContext: ['groups' => ['write']]
)]



class CurrencyExchange
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use CurrencyFilterTrait;
    use TimestampFilterTrait;
    use OrderFilterTrait;

    protected $currencySource;

    protected $currencyTarget;

    protected $currencyRatio;

}
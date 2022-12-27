<?php


namespace App\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\BaseTrait;
use App\Entity\MetaTrait;
use App\Entity\ObjectTrait;
use App\Entity\VendorLanguageTrait;
use App\Repository\Vendor\VendorRepository;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name: 'vendor_en_gb')]
#[ORM\Index(columns: ['slug'], name: 'vendor_en_gb_idx')]
#[ORM\Entity(repositoryClass: VendorRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
//HELP: https://digitalfortress.tech/tutorial/rest-api-with-symfony-and-api-platform/
#[ApiResource(
    collectionOperations: [],
    itemOperations: [
        'get',
        'put',
        'delete',
        'get_by_slug' => [
            'method' => 'GET',
            'path' => 'vendor/show/{slug}',
            'controller' => 'ObjectCRUDsController::class'
        ]
    ],
    denormalizationContext: ["group" => "write"],
    normalizationContext: ["group" => "read"],
    order: ["is_active" => "DESC", "locale" => "ASC"],
    paginationEnabled: false
)]
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]
#[ApiFilter(SearchFilter::class, properties: [
    "firstTitle" => "partial",
    "lastTitle" => "partial",
])]
class VendorEnGb
{
    use BaseTrait;
    use ObjectTrait;
    use MetaTrait;
    use VendorLanguageTrait;
}

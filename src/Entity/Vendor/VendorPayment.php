<?php


namespace App\Entity\Vendor;


use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Entity\ObjectBaseTrait;
use App\Repository\Vendor\VendorMessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VendorPayment
 * @package App\Entity\Vendor
 */
#[ORM\Table(name: 'vendor_payment')]
#[ORM\Index(columns: ['slug'], name: 'vendor_payment_idx')]
#[ORM\Entity(repositoryClass: VendorMessageRepository::class)]
#[ORM\HasLifecycleCallbacks]
#
#[ApiFilter(BooleanFilter::class, properties: ["isPublished"])]

class VendorPayment
{
    use ObjectBaseTrait;

}

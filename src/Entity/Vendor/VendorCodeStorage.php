<?php

namespace App\Entity\Vendor;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\CodeNameFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;


#[ORM\Table(
    name: 'vendor_sms_code_send_storage',
    indexes: [
        new ORM\Index(columns: ['expires_at'], name: 'idx_vendor_code_expires')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_vendor_code', columns: ['code'])
    ]
)]
#[ORM\Index(columns: ['phone'], name: 'sms_code_send_storage_idx')]
#[ORM\HasLifecycleCallbacks]
#
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(
            normalizationContext: ['groups' => ['read','item']]
        ),
        new Post(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Put(
            denormalizationContext: ['groups' => ['write']]
        ),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class VendorCodeStorage
{
    use BaseTrait; // Indexing and audition properties/columns
    use ObjectTrait; // Titling properties/columns
    # API Filters
    use TimestampFilterTrait;
    use CodeNameFilterTrait;

    #[ORM\Column(name: 'phone', type: 'string')]
    protected string $phone;

    #[ORM\Column(name: 'is_login', type: 'boolean')]
    protected bool $isLogin;

    #[ORM\ManyToOne(targetEntity: Vendor::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Vendor $vendor = null;

    public function getPhone(): string
    {
        return $this->phone;
    }
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
    public function getCode(): int
    {
        return $this->code;
    }
    public function setCode(int $code): void
    {
        $this->code = $code;
    }
    public function isLogin(): bool
    {
        return $this->isLogin;
    }
    public function setIsLogin(bool $isLogin): void
    {
        $this->isLogin = $isLogin;
    }
}
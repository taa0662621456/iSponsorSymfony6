<?php

namespace App\Entity\Vendor;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;
use App\Api\Filter\CommonFilterTrait;
use App\Entity\BaseTrait;
use App\Repository\Security\SecurityApiTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SecurityApiTokenRepository::class)]
#[ORM\Table(name: 'vendor_api_token')]
#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: ['groups' => ['read','list']]
        ),
        new Get(normalizationContext: ['groups' => ['read','item']]),
        new Post(denormalizationContext: ['groups' => ['write']]),
        new Put(denormalizationContext: ['groups' => ['write']]),
        new Delete(),
    ]
)]
class SecurityApiToken
{
    use BaseTrait;
    use CommonFilterTrait;

    #[ORM\Column(type: 'json', nullable: true)]
    #[Groups(['read','write'])]
    private ?array $scope = [];

    #[ORM\ManyToOne(targetEntity: VendorSecurity::class, inversedBy: 'apiTokens')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private VendorSecurity $vendor;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->token = bin2hex(random_bytes(32)); // 64-символьный ключ по умолчанию
        $this->scope = [];
        $this->ipRestriction = [];
    }

    #

    /**
     * @throws \Exception
     */
    public function regenerateToken(): void
    {
        $this->token = bin2hex(random_bytes(32));
    }

    #
    public function getScope(): array
    {
        return $this->scope ?? [];
    }

    public function setScope(array $scopes): void
    {
        $this->scope = $scopes;
    }

    public function hasScope(string $scope): bool
    {
        return in_array($scope, $this->getScope(), true);
    }

    public function getVendor(): VendorSecurity
    {
        return $this->vendor;
    }
    public function setVendor(VendorSecurity $vendor): void
    {
        $this->vendor = $vendor;
    }
}
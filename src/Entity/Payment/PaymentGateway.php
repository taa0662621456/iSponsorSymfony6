<?php

namespace App\Entity\Payment;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\CodeNameFilterTrait;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\ShipmentCoreFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Payment\PaymentGatewayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(
    name: 'payment_gateway',
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_payment_gateway_slug', columns: ['slug'])
    ]
)]
#[ORM\Index(columns: ['slug'], name: 'payment_gateway_idx')]
#[ORM\Entity(repositoryClass: PaymentGatewayRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new GetCollection(
            paginationEnabled: false,
            order: ['createdAt' => 'DESC'],
            normalizationContext: ['groups' => ['read','list']],
            denormalizationContext: ['groups' => ['write']]
        ),
        new Get(normalizationContext: ['groups' => ['read','item']]),
        new Post(denormalizationContext: ['groups' => ['write']]),
        new Put(denormalizationContext: ['groups' => ['write']]),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            normalizationContext: ['groups' => ['read','item']],
            name: 'get_by_slug'
        )
    ]
)]
class PaymentGateway
{
    use BaseTrait; // ID, slug, code, config, timestamps, encryption helpers
    use ObjectTrait; // Titles
    use TimestampFilterTrait;
    use RelationFilterTrait;
    use ShipmentCoreFilterTrait;
    use CodeNameFilterTrait;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $currencies = [];

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $sandboxMode = false;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $logoUrl = null;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $sortOrder = 0;

    #[ORM\OneToMany(mappedBy: 'gateway', targetEntity: PaymentMethod::class, cascade: ['persist', 'remove'])]
    private Collection $paymentMethod;

    public function __construct()
    {
        $this->currencies = [];
        $this->paymentMethod = new ArrayCollection();
    }

    public function getCurrencies(): array
    {
        return $this->currencies ?? [];
    }

    public function setCurrencies(array $currencies): void
    {
        $this->currencies = $currencies;
    }

    public function isSandboxMode(): bool
    {
        return $this->sandboxMode;
    }

    public function setSandboxMode(bool $sandboxMode): void
    {
        $this->sandboxMode = $sandboxMode;
    }

    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    public function setLogoUrl(?string $logoUrl): void
    {
        $this->logoUrl = $logoUrl;
    }

    public function getSortOrder(): int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): void
    {
        $this->sortOrder = $sortOrder;
    }

    /** @return Collection<int, PaymentMethod> */
    public function getPaymentMethod(): Collection
    {
        return $this->paymentMethod;
    }

    public function addPaymentMethod(PaymentMethod $method): void
    {
        if (!$this->paymentMethod->contains($method)) {
            $this->paymentMethod->add($method);
            $method->setGateway($this);
        }
    }

    public function removePaymentMethod(PaymentMethod $method): void
    {
        if ($this->paymentMethod->removeElement($method)) {
            if ($method->getGateway() === $this) {
                $method->setGateway(null);
            }
        }
    }
}

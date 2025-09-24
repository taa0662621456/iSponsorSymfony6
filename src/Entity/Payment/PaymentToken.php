<?php

namespace App\Entity\Payment;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Entity\BaseTrait;
use App\Repository\Payment\PaymentTokenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'payment_token')]
#[ORM\Entity(repositoryClass: PaymentTokenRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new GetCollection(order: ['createdAt' => 'DESC']),
        new Get(),
        new Post(),
        new Put(),
        new Delete(),
        new Get(
            uriTemplate: '/{_entity}/show/{slug}',
            controller: ObjectCRUDsController::class,
            name: 'get_by_slug'
        )
    ]
)]
class PaymentToken
{
    use BaseTrait;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $expiresAt;

    #[ORM\ManyToOne(targetEntity: PaymentMethod::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?PaymentMethod $method = null;

    public function __construct()
    {
        $this->expiresAt = (new \DateTimeImmutable())->modify('+1 hour');
    }

    public function getMethod(): ?PaymentMethod
    {
        return $this->method;
    }

    public function setMethod(?PaymentMethod $method): void
    {
        $this->method = $method;
    }
}

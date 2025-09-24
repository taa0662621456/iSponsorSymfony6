<?php

namespace App\Entity\Payment;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Api\Filter\RelationFilterTrait;
use App\Api\Filter\TimestampFilterTrait;
use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Repository\Payment\PaymentMethodRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\ObjectCRUDsController;

#[ORM\Table(name: 'payment_method')]
#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
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
class PaymentMethod
{
    use BaseTrait;
    use ObjectTrait;
    use TimestampFilterTrait;
    use RelationFilterTrait;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    private string $methodName;

    #[ORM\ManyToOne(targetEntity: PaymentGateway::class, inversedBy: 'paymentMethods')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?PaymentGateway $gateway = null;

    public function getMethodName(): string
    {
        return $this->methodName;
    }

    public function setMethodName(string $methodName): void
    {
        $this->methodName = $methodName;
    }

    public function getGateway(): ?PaymentGateway
    {
        return $this->gateway;
    }

    public function setGateway(?PaymentGateway $gateway): void
    {
        $this->gateway = $gateway;
    }
}

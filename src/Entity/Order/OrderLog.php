<?php

namespace App\Entity\Order;

use ApiPlatform\Metadata\ApiResource;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use App\Interface\Order\OrderLogInterface;
use App\Repository\Order\OrderRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'order_log')]
#[ORM\Index(columns: ['slug'], name: 'order_log_idx')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(mercure: true)]
final class OrderLog extends ObjectSuperEntity implements ObjectInterface, OrderLogInterface
{

    #[ORM\ManyToOne(targetEntity: OrderStatus::class)]
    private OrderStatus $orderStatusCode;

    #[ORM\Column(name: 'customer_notified', type: 'boolean', nullable: false)]
    private bool $customerNotified = false;

    #[ORM\Column(name: 'comment')]
    private ?string $comment = null;

    #[ORM\Column(name: 'o_hash')]
    private ?string $oHash = null;

    public function getOrderStatusCode(): OrderStatus
    {
        return $this->orderStatusCode;
    }

    public function setOrderStatusCode($orderStatusCode): void
    {
        $this->orderStatusCode = $orderStatusCode;
    }

    public function isCustomerNotified(): bool
    {
        return $this->customerNotified;
    }

    public function setCustomerNotified(bool $customerNotified): void
    {
        $this->customerNotified = $customerNotified;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getOHash(): ?string
    {
        return $this->oHash;
    }

    public function setOHash(?string $oHash): void
    {
        $this->oHash = $oHash;
    }
}

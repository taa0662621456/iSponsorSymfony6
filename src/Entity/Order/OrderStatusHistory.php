<?php
namespace App\Entity\Order;

use App\Enum\OrderStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'order_status_history')]
class OrderStatusHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'statusHistory')]
    #[ORM\JoinColumn(nullable: false)]
    private OrderStorage $order;

    #[ORM\Column(type: 'string', enumType: OrderStatus::class)]
    private OrderStatus $oldStatus;

    #[ORM\Column(type: 'string', enumType: OrderStatus::class)]
    private OrderStatus $newStatus;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $changedAt;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $changedBy = null;

    public function __construct(OrderStorage $order, OrderStatus $old, OrderStatus $new, ?string $by = null)
    {
        $this->order = $order;
        $this->oldStatus = $old;
        $this->newStatus = $new;
        $this->changedAt = new \DateTimeImmutable();
        $this->changedBy = $by;
    }
}

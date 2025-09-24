<?php

namespace App\Entity\Order;

use App\Entity\BaseTrait;
use App\Entity\ObjectTrait;
use App\Entity\Vendor\Vendor;
use App\Enum\ShipmentStatusEnum;
use App\Repository\Order\OrderShipmentRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ObjectCRUDsController;
use Symfony\Component\Uid\Uuid;

#[ORM\Table(
    name: 'order_shipment',
    indexes: [
        new ORM\Index(columns: ['status'], name: 'idx_order_shipment_status'),
        new ORM\Index(columns: ['order_id'], name: 'idx_order_shipment_order'),
        new ORM\Index(columns: ['vendor_id'], name: 'idx_order_shipment_vendor'),
        new ORM\Index(columns: ['created_at'], name: 'idx_order_shipment_created'),
        new ORM\Index(columns: ['delivered_at'], name: 'idx_order_shipment_delivered')
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(name: 'uniq_order_tracking_number', columns: ['tracking_number'])
    ]
)]
#[ORM\Index(columns: ['slug'], name: 'order_shipment_idx')]
#[ORM\Entity(repositoryClass: OrderShipmentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrderShipment
{
    use BaseTrait;
    use ObjectTrait;

    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'shipments')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?OrderStorage $order = null;

    #[ORM\ManyToOne(targetEntity: Vendor::class, inversedBy: 'shipments')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private ?Vendor $vendor = null;

    #[ORM\Column(name: 'shipment_status', type: 'string', enumType: ShipmentStatusEnum::class)]
    private ShipmentStatusEnum $status = ShipmentStatusEnum::Pending;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $shippedAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $deliveredAt = null;

    public function getOrder(): ?OrderStorage
    {
        return $this->order;
    }

    public function setOrder(?OrderStorage $order): void
    {
        $this->order = $order;
        if ($order !== null && !$order->getShipments()->contains($this)) {
            $order->addShipment($this);
        }
    }

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): void
    {
        $this->vendor = $vendor;
    }

    public function getShippedAt(): ?\DateTimeImmutable
    {
        return $this->shippedAt;
    }

    public function setShippedAt(?\DateTimeImmutable $date): void
    {
        $this->shippedAt = $date;
    }

    public function getDeliveredAt(): ?\DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    public function setDeliveredAt(?\DateTimeImmutable $date): void
    {
        $this->deliveredAt = $date;
    }

    public function getStatus(): ShipmentStatusEnum
    {
        return $this->status;
    }

    public function setStatus(ShipmentStatusEnum $status): void
    {
        $this->status = $status;
    }
}

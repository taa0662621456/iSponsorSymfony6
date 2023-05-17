<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\ObjectSuperEntity;
use App\Interface\Object\ObjectInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\EntityInterface\Order\OrderStatusInterface;

#[ORM\Entity]
class OrderStatus extends ObjectSuperEntity implements ObjectInterface, OrderStatusInterface
{
    #[ORM\Column(name: 'order_status_code', type: 'string', nullable: false, options: ['default' => ''])]
    private string $orderStatusCode = '';

    #[ORM\Column(name: 'order_status_name', nullable: true)]
    private ?string $orderStatusName = null;

    #[ORM\Column(name: 'order_status_color', nullable: true)]
    private ?string $orderStatusColor = null;

    #[ORM\Column(name: 'order_status_description', nullable: true)]
    private ?string $orderStatusDescription = null;

    #[ORM\Column(name: 'order_stock_handle', type: 'string', nullable: false, options: ['default' => 'A'])]
    private string $orderStockHandle = 'A';

    #[ORM\Column(name: 'ordering', type: 'integer', nullable: false)]
    private int $ordering = 0;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(mappedBy: 'orderStatus', targetEntity: OrderStorage::class)]
    private Collection $orderStatusStorage;

    public function __construct()
    {
        parent::__construct();
        $this->orderStatusStorage = new ArrayCollection();
    }
}

<?php

namespace App\Entity\Order;

use App\Entity\Embeddable\ObjectProperty;
use App\Entity\RootEntity;
use App\EntityInterface\Order\OrderDiscountInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\EntityInterface\Object\ObjectInterface;

#[ORM\Entity]
class OrderDiscount extends RootEntity implements ObjectInterface, OrderDiscountInterface
{
    #[ORM\Embedded(class: ObjectProperty::class)]
    private ObjectProperty $objectProperty;

    /**
     * @var ArrayCollection
     */
    #[ORM\ManyToOne(targetEntity: OrderStorage::class, inversedBy: 'orderDiscount')]
    private Collection $orderDiscount;

    /**
     * @return Collection
     */
    public function getOrderDiscount(): Collection
    {
        return $this->orderDiscount;
    }

    /**
     * @param Collection $orderDiscount
     */
    public function setOrderDiscount(Collection $orderDiscount): void
    {
        $this->orderDiscount = $orderDiscount;
    }




}
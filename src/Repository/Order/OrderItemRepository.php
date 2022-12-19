<?php

namespace App\Repository\Order;



use Doctrine\ORM\EntityRepository;

class OrderItemRepository extends EntityRepository implements OrderItemRepositoryInterface
{
    public function findOneByIdAndCartId($id, $cartId): ?OrderItemInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'cart')
            ->andWhere('cart.state = :state')
            ->andWhere('o.id = :id')
            ->andWhere('cart.id = :cartId')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('id', $id)
            ->setParameter('cartId', $cartId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findOneByIdAndCartTokenValue($id, $tokenValue): ?OrderItemInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'cart')
            ->andWhere('cart.state = :state')
            ->andWhere('o.id = :id')
            ->andWhere('cart.tokenValue = :tokenValue')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('id', $id)
            ->setParameter('tokenValue', $tokenValue)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

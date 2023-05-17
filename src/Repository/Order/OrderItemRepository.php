<?php

namespace App\Repository\Order;



use App\Entity\Order\OrderStorage;
use App\EntityInterface\Order\OrderItemInterface;
use App\RepositoryInterface\Order\OrderItemRepositoryInterface;
use App\Repository\EntityRepository;
/**
 * @method OrderStorage|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderStorage|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderStorage[]    findAll()
 * @method OrderStorage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
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

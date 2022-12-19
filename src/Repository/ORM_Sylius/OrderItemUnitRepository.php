<?php


namespace App\Repository\ORM_Sylius;





use Doctrine\ORM\EntityRepository;

class OrderItemUnitRepository extends EntityRepository implements OrderItemUnitRepositoryInterface
{
    public function findOneByCustomer($id, CustomerInterface $customer): ?OrderItemUnitInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.orderItem', 'orderItem')
            ->innerJoin('orderItem.order', 'ord')
            ->innerJoin('ord.customer', 'customer')
            ->andWhere('o.id = :id')
            ->andWhere('customer = :customer')
            ->setParameter('id', $id)
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

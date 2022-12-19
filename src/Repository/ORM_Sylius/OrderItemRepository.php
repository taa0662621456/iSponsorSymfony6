<?php


namespace App\CoreBundle\Doctrine\ORM;





class OrderItemRepository extends BaseOrderItemRepository implements OrderItemRepositoryInterface
{
    public function findOneByIdAndCustomer($id, CustomerInterface $customer): ?OrderItemInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'ord')
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

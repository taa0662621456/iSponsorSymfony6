<?php


namespace App\CoreBundle\Doctrine\ORM;





class AddressRepository extends EntityRepository implements AddressRepositoryInterface
{
    public function findByCustomer(CustomerInterface $customer): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.customer', 'customer')
            ->andWhere('customer = :customer')
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByCustomer(string $id, CustomerInterface $customer): ?AddressInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.customer', 'customer')
            ->andWhere('o.id = :id')
            ->andWhere('customer = :customer')
            ->setParameter('id', $id)
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

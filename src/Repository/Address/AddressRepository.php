<?php


namespace App\Repository\Address;





use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Address\AddressRepositoryInterface;
use App\Interface\CustomerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

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

    /**
     * @throws NonUniqueResultException
     */
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

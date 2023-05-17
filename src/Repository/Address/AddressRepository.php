<?php

namespace App\Repository\Address;

use App\Entity\Address\Address;
use App\EntityInterface\Address\AddressInterface;
use App\EntityInterface\Address\AddressRepositoryInterface;
use App\EntityInterface\Customer\CustomerInterface;
use App\Repository\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Address|null find($id, $lockMode = null, $lockVersion = null)
 * @method Address|null findOneBy(array $criteria, array $orderBy = null)
 * @method Address[]    findAll()
 * @method Address[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
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

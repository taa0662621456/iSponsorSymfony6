<?php

namespace App\Repository;

use App\Entity\Vendor\VendorShipment;
use App\RepositoryInterface\Customer\CustomerRepositoryInterface;
use DateTimeInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method VendorShipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method VendorShipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method VendorShipment[]    findAll()
 * @method VendorShipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends EntityRepository implements CustomerRepositoryInterface
{
    public function countCustomer(): int
    {
        try {
            return (int)$this->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException|NonUniqueResultException $e) {
        }
    }

    public function countCustomerPerPeriod(DateTimeInterface $startDate, DateTimeInterface $endDate): int
    {
        try {
            return (int)$this->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->where('o.createdAt >= :startDate')
                ->andWhere('o.createdAt <= :endDate')
                ->setParameter('startDate', $startDate)
                ->setParameter('endDate', $endDate)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException|NonUniqueResultException $e) {
        }
    }

    public function findLatest(int $count): array
    {
        return $this->createQueryBuilder('o')
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }
}

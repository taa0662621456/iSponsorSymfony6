<?php

namespace App\Repository\Payment;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Payment\Payment;
use App\Repository\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use App\EntityInterface\Payment\PaymentInterface;
use App\EntityInterface\Customer\CustomerInterface;
use App\RepositoryInterface\Payment\PaymentRepositoryInterface;

/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentRepository extends EntityRepository implements PaymentRepositoryInterface
{
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state != :state')
            ->setParameter('state', PaymentInterface::STATE_CART);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneByOrderId(int $paymentId, int $orderId): ?PaymentInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->andWhere('o.id = :paymentId')
                ->andWhere('o.order = :orderId')
                ->setParameter('paymentId', $paymentId)
                ->setParameter('orderId', $orderId)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw $e;
        }
    }

    public function findOneByOrderToken(string $paymentId, string $orderToken): ?PaymentInterface
    {
        try {
            return $this->createQueryBuilder('p')
                ->innerJoin('p.order', 'o')
                ->andWhere('p.id = :paymentId')
                ->andWhere('o.tokenValue = :orderToken')
                ->setParameter('paymentId', $paymentId)
                ->setParameter('orderToken', $orderToken)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            throw $e;
        }
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneByCustomer($id, CustomerInterface $customer): ?PaymentInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.order', 'ord')
            ->innerJoin('ord.customer', 'customer')
            ->andWhere('o.id = :id')
            ->andWhere('customer = :customer')
            ->setParameter('id', $id)
            ->setParameter('customer', $customer)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

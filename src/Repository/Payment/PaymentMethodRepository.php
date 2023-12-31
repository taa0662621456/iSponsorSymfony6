<?php

namespace App\Repository\Payment;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Payment\Payment;
use App\Repository\EntityRepository;
use App\EntityInterface\Vendor\VendorInterface;
use App\RepositoryInterface\Payment\PaymentMethodRepositoryInterface;

/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentMethodRepository extends EntityRepository implements PaymentMethodRepositoryInterface
{
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult();
    }

    public function createPaginator(array $criteria = [], array $sorting = []): iterable
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->leftJoin('o.translations', 'translation');

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $sorting);

        return $this->getPaginator($queryBuilder);
    }

    public function createListQueryBuilder(string $locale): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.gatewayConfig', 'gatewayConfig')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->setParameter('locale', $locale);
    }

    public function findEnabledForVendor(VendorInterface $vendor): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.enabled = :enabled')
            ->andWhere(':vendor MEMBER OF o.vendors')
            ->setParameter('vendor', $vendor)
            ->setParameter('enabled', true)
            ->addOrderBy('o.position')
            ->getQuery()
            ->getResult();
    }
}

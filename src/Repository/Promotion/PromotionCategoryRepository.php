<?php

namespace App\Repository\Promotion;

use App\Entity\Promotion\Promotion;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Promotion\PromotionCategoryRepositoryInterface;

/**
 * @method Promotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotion[]    findAll()
 * @method Promotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionCategoryRepository extends EntityRepository implements PromotionCategoryRepositoryInterface
{
    public function findByCriteria(iterable $criteria): array
    {
        $queryBuilder = $this->createQueryBuilder('o');

        /** @var CriteriaInterface $criterion */
        foreach ($criteria as $criterion) {
            $criterion->filterQueryBuilder($queryBuilder);
        }

        return $queryBuilder
            ->addSelect('scopes')
            ->addSelect('actions')
            ->leftJoin('o.scopes', 'scopes')
            ->leftJoin('o.actions', 'actions')
            ->orderBy('o.exclusive', 'desc')
            ->addOrderBy('o.priority', 'desc')
            ->getQuery()
            ->getResult();
    }
}

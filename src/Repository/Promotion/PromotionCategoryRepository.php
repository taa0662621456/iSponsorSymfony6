<?php

namespace App\Repository\Promotion;

use Doctrine\ORM\EntityRepository;

class PromotionCategoryRepository extends EntityRepository implements CatalogPromotionRepositoryInterface
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
            ->getResult()
        ;
    }
}
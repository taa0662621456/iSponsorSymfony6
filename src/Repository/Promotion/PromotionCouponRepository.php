<?php

namespace App\Repository\Promotion;

use App\EntityInterface\Promotion\PromotionCouponInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Promotion\Promotion;
use App\Repository\EntityRepository;
use App\RepositoryInterface\Promotion\PromotionCouponRepositoryInterface;
use function strlen;

/**
 * @method Promotion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Promotion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Promotion[]    findAll()
 * @method Promotion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionCouponRepository extends EntityRepository implements PromotionCouponRepositoryInterface
{
    public function createQueryBuilderByPromotionId($promotionId): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.promotion = :promotionId')
            ->setParameter('promotionId', $promotionId);
    }

    public function countByCodeLength(
        int $codeLength,
        string $prefix = null,
        string $suffix = null,
    ): int {
        if (null !== $prefix) {
            $codeLength += strlen($prefix);
        }
        if (null !== $suffix) {
            $codeLength += strlen($suffix);
        }
        $codeTemplate = $prefix.'%'.$suffix;

        try {
            return (int)$this->createQueryBuilder('o')
                ->select('COUNT(o.id)')
                ->andWhere('LENGTH(o.code) = :codeLength')
                ->andWhere('o.code LIKE :codeTemplate')
                ->setParameter('codeLength', $codeLength)
                ->setParameter('codeTemplate', $codeTemplate)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException|NonUniqueResultException $e) {
        }
    }

    public function findOneByCodeAndPromotionCode(string $code, string $promotionCode): ?PromotionCouponInterface
    {
        try {
            return $this->createQueryBuilder('o')
                ->leftJoin('o.promotion', 'promotion')
                ->where('promotion.code = :promotionCode')
                ->andWhere('o.code = :code')
                ->setParameter('promotionCode', $promotionCode)
                ->setParameter('code', $code)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function createPaginatorForPromotion(string $promotionCode): iterable
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->leftJoin('o.promotion', 'promotion')
            ->where('promotion.code = :promotionCode')
            ->setParameter('promotionCode', $promotionCode);

        return $this->getPaginator($queryBuilder);
    }
}

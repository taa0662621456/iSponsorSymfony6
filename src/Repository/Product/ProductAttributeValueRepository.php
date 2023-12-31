<?php

namespace App\Repository\Product;

use Doctrine\ORM\QueryBuilder;
use App\Repository\EntityRepository;
use App\Entity\Product\ProductAttachment;
use App\RepositoryInterface\Product\ProductAttributeValueRepositoryInterface;

/**
 * @method ProductAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAttachment[]    findAll()
 * @method ProductAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductAttributeValueRepository extends EntityRepository implements ProductAttributeValueRepositoryInterface
{
    public function findByJsonChoiceKey($key): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.json LIKE :key')
            ->setParameter('key', '%"'.$key.'"%')
            ->getQuery()
            ->getResult();
    }

    public function createByProductCodeAndLocaleQueryBuilder(
        string $productCode,
        string $localeCode,
        string $fallbackLocaleCode = null,
        string $defaultLocaleCode = null,
    ): QueryBuilder {
        $acceptableLocaleCodes = [$localeCode];

        if (null !== $fallbackLocaleCode) {
            $acceptableLocaleCodes[] = $fallbackLocaleCode;
        }

        if (null !== $defaultLocaleCode && array_count_values($acceptableLocaleCodes)[$localeCode] > 1) {
            $acceptableLocaleCodes[] = $defaultLocaleCode;
        }

        $subQuery = $this->createQueryBuilder('s')
            ->select('IDENTITY(s.attribute)')
            ->innerJoin('s.subject', 'subject')
            ->andWhere('subject.code = :code')
            ->andWhere('s.localeCode = :locale');

        $queryBuilder = $this->createQueryBuilder('o');

        return $queryBuilder
            ->innerJoin('o.subject', 'product')
            ->andWhere('product.code = :code')
            ->andWhere(
                $queryBuilder->expr()->orX(
                    $queryBuilder->expr()->in('o.localeCode', $acceptableLocaleCodes),
                    $queryBuilder->expr()->isNull('o.localeCode'),
                ),
            )
            ->andWhere(
                $queryBuilder->expr()->orX(
                    'o.localeCode = :locale',
                    $queryBuilder->expr()->notIn('IDENTITY(o.attribute)', $subQuery->getDQL()),
                ),
            )
            ->setParameter('code', $productCode)
            ->setParameter('locale', $localeCode);
    }
}

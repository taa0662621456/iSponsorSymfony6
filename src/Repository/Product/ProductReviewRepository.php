<?php

namespace App\Repository\Product;

use App\EntityInterface\Product\ProductReviewInterface;
use App\EntityInterface\Vendor\VendorInterface;
use Doctrine\ORM\QueryBuilder;
use App\Repository\EntityRepository;
use App\Entity\Product\ProductReview;
use Doctrine\ORM\NonUniqueResultException;
use App\RepositoryInterface\Product\ProductReviewRepositoryInterface;

/**
 * @method ProductReview|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductReview|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductReview[]    findAll()
 * @method ProductReview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductReviewRepository extends EntityRepository implements ProductReviewRepositoryInterface
{
    public const STATUS_ACCEPTED = '';

    public function findLatestByProductId($productId, int $count): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.reviewSubject = :productId')
            ->andWhere('o.status = :status')
            ->setParameter('productId', $productId)
//            ->setParameter('status', ProductReviewInterface::STATUS_ACCEPTED)
            ->setParameter('status', self::STATUS_ACCEPTED)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult();
    }

    public function findAcceptedByProductSlugAndVendor(string $slug, string $locale, VendorInterface $vendor): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.reviewSubject', 'product')
            ->innerJoin('product.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->andWhere('translation.slug = :slug')
            ->andWhere(':vendor MEMBER OF product.vendors')
            ->andWhere('o.status = :status')
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
            ->setParameter('vendor', $vendor)
            ->setParameter('status', self::STATUS_ACCEPTED)
            ->getQuery()
            ->getResult();
    }

    public function createQueryBuilderByProductCode(string $locale, string $productCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.reviewSubject', 'product')
            ->innerJoin('product.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->andWhere('product.code = :productCode')
            ->setParameter('locale', $locale)
            ->setParameter('productCode', $productCode);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findOneByIdAndProductCode($id, string $productCode): ?ProductReviewInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.reviewSubject', 'product')
            ->andWhere('product.code = :productCode')
            ->andWhere('o.id = :id')
            ->setParameter('productCode', $productCode)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

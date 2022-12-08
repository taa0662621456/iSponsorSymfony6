<?php


namespace App\CoreBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;




class ProductReviewRepository extends EntityRepository implements ProductReviewRepositoryInterface
{
    public function findLatestByProductId($productId, int $count): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.reviewSubject = :productId')
            ->andWhere('o.status = :status')
            ->setParameter('productId', $productId)
            ->setParameter('status', ReviewInterface::STATUS_ACCEPTED)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAcceptedByProductSlugAndChannel(string $slug, string $locale, ChannelInterface $channel): array
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.reviewSubject', 'product')
            ->innerJoin('product.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->andWhere('translation.slug = :slug')
            ->andWhere(':channel MEMBER OF product.channels')
            ->andWhere('o.status = :status')
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
            ->setParameter('channel', $channel)
            ->setParameter('status', ReviewInterface::STATUS_ACCEPTED)
            ->getQuery()
            ->getResult()
        ;
    }

    public function createQueryBuilderByProductCode(string $locale, string $productCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.reviewSubject', 'product')
            ->innerJoin('product.translations', 'translation')
            ->andWhere('translation.locale = :locale')
            ->andWhere('product.code = :productCode')
            ->setParameter('locale', $locale)
            ->setParameter('productCode', $productCode)
        ;
    }

    public function findOneByIdAndProductCode($id, string $productCode): ?ReviewInterface
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.reviewSubject', 'product')
            ->andWhere('product.code = :productCode')
            ->andWhere('o.id = :id')
            ->setParameter('productCode', $productCode)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

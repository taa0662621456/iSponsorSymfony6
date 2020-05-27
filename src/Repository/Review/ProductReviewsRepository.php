<?php

namespace App\Repository\Review;

use App\Entity\Review\ProductReviews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method ProductReviews|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductReviews|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductReviews[]    findAll()
 * @method ProductReviews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductReviewsRepository extends ServiceEntityRepository
{
    public const REVIEWS_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductReviews::class);
    }

    public function getReviewsPerPage(ProductReviews $productReviews, int $offset): Paginator
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.slug = :product')
            ->andWhere('r.published = :published')
            ->setParameter('product', $productReviews)
            ->setParameter('published', true)
            ->orderBy('r.createdAt', 'DESC')
            ->setMaxResults(self::REVIEWS_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery();

        return new Paginator($qb);

    }

    public function deleteOldRejectedReviews()
    {
        return $this->getOldRejectedReviewsQueryBuilder()->delete()->getQuery()->execute();
    }

    public function countOldRejected(): int
    {
        return $this->getOldRejectedReviewsQueryBuilder()->select('COUNT(r.id)')->getQuery()->getSingleScalarResult();
    }

    public function getOldRejectedReviewsQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.state = :state_rejected or r.state = :state_spam')
            ->andWhere('r.createdAt < :date')
            ->setParameters([
                'state_rejected' => 'rejected',
                'state_spam' => 'spam',
                'date' => new \DateTime(-self::DAYS_BEFORE_REJECTED_REMOVAL),
            ]);
    }
}

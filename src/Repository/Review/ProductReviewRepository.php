<?php

namespace App\Repository\Review;

use DateTime;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\NoResultException;
use App\Repository\EntityRepository;
use App\Entity\Product\ProductReview;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\RepositoryInterface\Product\ProductReviewRepositoryInterface;
use Exception;

/**
 * @method ProductReview|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductReview|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductReview[]    findAll()
 * @method ProductReview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductReviewRepository extends EntityRepository implements ProductReviewRepositoryInterface
{
    public const REVIEWS_PER_PAGE = 10;

    public const DAYS_BEFORE_REJECTED_REMOVAL = '';

    public function getReviewsPerPage(ProductReview $productReviews, int $offset): Paginator
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

    /**
     * @throws Exception
     */
    public function deleteOldRejectedReviews()
    {
        return $this->getOldRejectedReviewsQueryBuilder()->delete()->getQuery()->execute();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     * @throws Exception
     */
    public function countOldRejected(): int
    {
        return $this->getOldRejectedReviewsQueryBuilder()->select('COUNT(r.id)')->getQuery()->getSingleScalarResult();
    }

    /**
     * @throws Exception
     */
    public function getOldRejectedReviewsQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.state = :state_rejected or r.state = :state_spam')
            ->andWhere('r.createdAt < :date')
            ->setParameters([
                'state_rejected' => 'rejected',
                'state_spam' => 'spam',
                'date' => new DateTime(-self::DAYS_BEFORE_REJECTED_REMOVAL),
            ]);
    }
}

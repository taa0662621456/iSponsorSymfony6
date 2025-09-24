<?php


namespace App\Repository\Review;


use App\Entity\Review\ProjectReview;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @method ProjectReview|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectReview|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectReview[]    findAll()
 * @method ProjectReview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectReviewRepository extends ServiceEntityRepository
{
    public const DAYS_BEFORE_REJECTED_REMOVAL = 7;
    public const REVIEWS_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectReview::class);
    }

    public function getReviewsPerPage(ProjectReview $projectReviews, int $offset): Paginator
    {
        $qb = $this->createQueryBuilder('r')
            ->andWhere('r.slug = :product')
            ->setParameter('product', $projectReviews)
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